<template>
<div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h3> Add Items </h3></div>
            <br>
            <div class="panel-body">
            <form @submit.prevent="submit"  class="form-horizontal" id="additem-form" method="POST">
                <div class="form-group">
                    <label class="col-md-4 control-label">Name:</label>
                    <input type="text" class="input" name="name" id="name" v-model="fields.name">
                    <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Category:</label>
                        <select name="category" id="category" v-model="fields.category">
                            <option v-for="category in categories" v-bind:key="category.id" v-bind:value=" category.id ">
                                {{ category.name }}
                            </option>
                        </select>
                        <div v-if="errors && errors.category" class="text-danger">{{ errors.category[0] }}</div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Serial Number:</label>
                    <input type="text" class="input" name="serial_number" id="serial_number" v-model="fields.serial_number">
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Number of Items:</label>
                    <input type="number" class="input" name="num_items" id="num_items" v-model="fields.num_items">
                    <div v-if="errors && errors.num_items" class="text-danger">{{ errors.num_items[0] }}</div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Description:</label>
                    <input type="text" class="input" name="description" id="description" v-model="fields.description" style="width: 200px; height: 50px">
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
                 <div v-if="success" class="alert alert-success mt-3">
                    Item was successfully added!
                </div>
            </form>
            </div>
        </div>
    </div>
</template>

<script>

export default {

    props : {
        categories: {
            type: Array,
        }
    },
    data () {

        return {
            fields: {},
            errors: {},
            success: false,
            loaded: true,
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

        submit() {
            if (this.loaded) {
                this.loaded = false;
                this.success = false;
                this.errors = {};
                console.log(JSON.stringify(this.fields));
                axios.post('/addItem', {

                        name: this.fields.name,
                        category: this.fields.category,
                        serial_number: this.fields.serial_number,
                        num_items: this.fields.num_items,
                        description: this.fields.description

                    }).then(response => {
                    this.fields = {}; //Clear input fields.
                    this.loaded = true;
                    this.success = true;
                }).catch(error => {
                    this.loaded = true;
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            }
        },

        handleResize() {
            this.window.width = window.innerWidth;
            this.window.height = window.innerHeight;
        },
        addItems() {

        }    
    }
};

</script>