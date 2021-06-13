<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Product</div>

                <div class="card-body">
                            <div class="row">
                            <div class="col-md-12">
                                <form @submit.prevent="UpdateProduct">
                                <div class="form-group">
                                    <label>name</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    v-model="product.name"
                                    required
                                    />
                                </div>
                                 <label>Select Category</label>
                                <div class="form-group">
                                    <select selected value class='form-control mb-4 ' v-model="product.category">
                              <option v-for="categories in products" :key="categories.id" :value="categories.category">{{categories.category}}</option>
                              
                               
                            </select>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    v-model="product.description"
                                     required
                                    />
                                </div>
                                <div class="form-group">
                                    <label>date and time</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    v-model="product.date_time"
                                     required
                                    />
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
 
<script>
export default {
  data() {
    return {
      product:{},
      products:{}
    }
  },
  mounted(){
            this.category_list()
            this.edit()
        },
  methods: {
    UpdateProduct() {
      axios
        .post(`/api/product/update/${this.$route.params.id}`,this.product)
        .then((response) => this.$router.push({ path: "/" }));
    },

    category_list(){
              axios.get('/api/product/category/show').then( response =>{
                  this.products = response.data;
                  console.log(response)      
              })
    },
    edit(){
            axios.get(`/api/product/edit/${this.$route.params.id}`)
            .then((response)=>{
                this.product =response.data;
            })
    }
      
  },
}
</script>