<template>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Team Inventory for {{ this.team }}</h3>
                <h3><a :href="'/addItemForm/'">Add Item</a></h3></div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col" v-if="window.width > 600">Description</th>
                            <th scope="col">Category</th>
                            <th scope="col">Availability</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in items" v-bind:key="item.id">
                            <th scope="row"><a :href="'/item/' + item.id">{{ item.name }}</a></th>
                            <td v-if="window.width > 600">{{ item.description }}</td>
                            <td>{{ item.category }}</td>
                            <td>{{ item.available }}/{{ item.total}}</td>
                            </tr>
                        </tbody>
                    </table>
                <center><nav aria-label="Page navigation e ample" v-if="item_count > 5">
                    <ul class="pagination">
                        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchItems(pagination.prev_page_url)">Previous</a></li>
                        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchItems(pagination.next_page_url)">Next</a></li>
                    </ul>
                </nav></center>
            </div>
        </div>
    </div>
</template>

<script>


export default {

    props : ['team'],
    data () {
        return {
            items: [],
            pagination: {},
            item_count: 0,
            window: {
                width: 2000,
                height: 2000
            }
        };
    },

    created() {
        this.fetchItems();
        window.addEventListener('resize', this.handleResize)
        this.handleResize();
    },

    destroyed() {
        window.removeEventListener('resize', this.handleResize)
    },

    methods: {
        fetchItems(page_url) {
            let vm = this;
            page_url = page_url || '/getTeamInventory/' + this.team;
            fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.items = res.data;
                    this.item_count = res.meta.total;
                    console.log(this.items);
                    vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
        },
        handleResize() {
            this.window.width = window.innerWidth;
            this.window.height = window.innerHeight;
        },
        makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };
                this.pagination = pagination;
        },    
    }
};
</script>