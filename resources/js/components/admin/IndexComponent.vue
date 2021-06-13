<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>
                    <div class="card-body">
                        <router-link to="/create" class="btn btn-primary mb-4">Add Product</router-link>
                       <input type="text" @keyup="searchUnit" placeholder="Search" v-model="search" class="form-control form-control mb-4">
                        <label>Select Category:</label>
 
                            <select class='form-control mb-4 ' v-model="category" @change="filterCategory()">
                                <option v-for="categories in products" :key="categories.id" :value="categories.category">{{categories.category}}</option>
                               
                            </select>
                       <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Description</th>
                                <th scope="col">Date</th>
                                 <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in product.data" :key="product.id">
                                <td>{{product.name}}</td>
                                <td>{{product.category}}</td>
                                <td>{{product.description}}</td>
                                <td>{{product.date_time}}</td>
                                 <td>
                                    <div class="btn-group" role="group">
                                        <router-link :to="{name: 'edit', params: { id: product.id }}" class="btn btn-primary">Edit
                                          </router-link>
                                        <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button>
                                    </div>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                    </div>
                     <pagination align="center" :data="product" @pagination-change-page="list"></pagination>
                </div>
            </div>
        </div>
    </div>
 
</template>
<script>
  import pagination from 'laravel-vue-pagination'
    import _ from "lodash";
    export default {
        name:"product",
        components:{
            pagination
        },
        data(){
            return {
                product:{},
                products:{},
                category:{},
                search: ''
               
            }
        },
        mounted(){
            this.list()
            this.category_list()
        },
        methods:{
            async list(page=1){
                await axios.get(`/api/product/view?page=${page}`).then(({data})=>{
                    this.product = data
                }).catch(({response})=>{
                    console.log(response)
                })
            },
         category_list(){
              axios.get('/api/product/category/show').then( response =>{
                  this.products = response.data;
                  console.log(response)      
              })
             },
               searchUnit:_.debounce(function(){
          axios.get('api/product/search?search='+this.search)
                .then((response)=>{
                this.product.data = response.data.data
               })

             }),
            deleteProduct(id){
                axios.delete(`/api/product/delete/${id}`)
                .then(response =>{
                       this.list()
                });
            },
             filterCategory() {
              axios.get('/api/product/category',
                  {params:{
                  category:this.category
              }})
              .then((response)=>{
                 this.product = response.data;
                 console.log(this.product)
              })
            }
        },
    }
</script>