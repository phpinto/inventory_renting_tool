<template>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h3>Transactions for {{ this.user_full_name }}</h3></div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Borrow Date</th>
                            <th scope="col">Return Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="transaction in transactions" v-bind:key="transaction.id">
                            <th scope="row"><a :href="'/item/' + transaction.item_id">{{ transaction.item_name }}</a></th>
                            <td> {{ transaction.borrowed_at }}</td>
                            <td v-if="transaction.returned_at !== null">{{ transaction.returned_at }}</td>
                            <td v-else><i>Not Yet Returned</i></td>
                            </tr>
                        </tbody>
                </table>
                <center><nav aria-label="Page navigation e ample" v-if="transaction_count > 5">
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

    props : ['id', 'user_full_name'],
    data () {
        return {
            transactions: [],
            pagination: {},
            transaction_count: 0,
            window: {
                width: 2000,
                height: 2000
            }
        };
    },

    created() {
        this.fetchTransactions();
        window.addEventListener('resize', this.handleResize)
        this.handleResize();
    },

    destroyed() {
        window.removeEventListener('resize', this.handleResize)
    },

    methods: {
        fetchTransactions(page_url) {
            let vm = this;
            page_url = page_url || '/getTransactions/' + this.id;
            fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.transactions = res.data;
                    this.item_count = res.meta.total;
                    console.log(this.transactions);
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
