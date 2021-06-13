<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adding Product</div>

                <div class="card-body">
                            <div class="row">
                            <div class="col-md-12">
                              <span style="color:red;" v-for="e in error" :key="e.index" > {{e}}</span>
                                <form @submit.prevent="CreateProduct">
                                        <!-- step 1 -->
                                            <section v-if="step == 1">
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
                               </section>
                              <!-- end step 1 -->
                              <!-- step 2 -->
                                    <section v-if="step == 2">
                                    <input
                                    type="file"
                                     required
                                    />
                              
                                    </section>
                              <!-- end step 2 -->
                              <!-- step 3 -->
                                     <section v-if="step == 3">
                                       <label>date and time</label>
                                    <input
                                    type="date"
                                    class="form-control"
                                    v-model="product.date_time"
                                  
                                    />
                              
                                    </section>
                              <!-- end step 3 -->
                                <button v-if="step == 3" type="submit" class="btn btn-primary mt-4">Add Product</button>
                                   <button v-if="step != 1" @click.prevent="prevStep" class="btn btn-primary mt-4">Previous Step</button>
                                 <button v-if="step != totalSteps" @click.prevent="nextStep" class="btn btn-primary mt-4">Next Step</button>
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
      step:1,
      totalSteps:3,
      error: [],
      product:{},
      products:{}  
    }
  },
  mounted(){
            this.category_list()
        },
  methods: {
    CreateProduct() {
      if(this.step == 3){
        if(!this.product.date_time)
        {
            this.error = "Please fill out Date and Time";
            return false;
        }

      }
      axios
        .post("/api/product/store", this.product)
        .then((response) => this.$router.push({ path: "/" }));
    },

    category_list(){
              axios.get('/api/product/category/show').then( response =>{
                  this.products = response.data;
                  console.log(response)      
              })
    },
    nextStep(){
      if(this.step == 1){
          if(!this.product.name)
          {
            this.error = "Please fill out product name";
            return false;
          }
           if(!this.product.category)
          {
            this.error = "Please fill out category";
            return false;
          }
           if(!this.product.description)
          {
            this.error = "Please fill out description";
            return false;
          }
      }
      if(this.step == 3){
        if(!this.product.date_time){
              this.error = "Please fill out date";
            return false;
        }
      }
      this.step++;
    },
    prevStep(){
      this.step--;
    }
      
  },
}
</script>