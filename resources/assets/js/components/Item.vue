<template>
<div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h3> {{ item.name }} </h3></div>
                <div class="panel-body">
                    <table class="table table-active" v-if="item.description !== null">
                        <thead><th scope="col">Description:</th></thead>
                        <tbody><td>&#9642; {{ item.description }}</td></tbody>
                        <thead><th scope="col">Location:</th></thead>
                        <tbody>
                            <td>&#9642; {{ item.cabinet }}</td>
                        </tbody>
                        <thead><th scope="col">Purchase Info:</th></thead>
                        <tbody>
                            <tr>&#9642; Model: {{ item.model }}</tr>
                            <tr>&#9642; Manufacturer: {{ item.manufacturer }}</tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</template>

<script>

export default {

    props : {
        item: Object
    },
    data () {
        return {
            window: {
                width: 2000,
                height: 2000
            }
        };
    },

    created() {
        window.addEventListener('resize', this.handleResize)
        this.handleResize();
    },

    destroyed() {
        window.removeEventListener('resize', this.handleResize);
    },

    methods: {
        handleResize() {
            this.window.width = window.innerWidth;
            this.window.height = window.innerHeight;
        },    
    }
};

</script>