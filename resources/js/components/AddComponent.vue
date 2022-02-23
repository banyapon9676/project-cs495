<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col">
                <h1>Add Furnitures</h1>
              </div>
              <form @submit.stop.prevent="addProduct()">
                <label for="name">Furnitures Name</label>
                <input
                  type="text"
                  id="name"
                  v-model="productName"
                  class="form-control"
                  required
                />
                <label for="img">Image Url</label>
                <input
                  type="text"
                  id="img"
                  v-model="productImg"
                  class="form-control"
                  required
                />
                <label for="price">Price</label>
                <input
                  type="number"
                  id="price"
                  v-model="price"
                  class="form-control"
                  required
                />
                <label for="des">Description</label>
                <textarea
                  id="des"
                  v-model="description"
                  rows="3"
                  class="form-control"
                  required
                />
                <div class="mt-3 text-end">
                  <button type="reset" class="btn btn-danger mr-2">
                    Cancel
                  </button>
                  <button type="submit" class="btn btn-success">Save</button>
                </div>
              </form>
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
      // for form
      productName: null,
      productImg: null,
      price: null,
      description: null,
    };
  },
  methods: {
    // Add product function
    addProduct() {
      axios
        .post("/api/product/store", {
          name: this.productName,
          image: this.productImg,
          price: this.price,
          description: this.description,
        })
        .then(() => {
          alert("Add product success.");
          window.location.reload();
        })
        .catch((err) => alert(err));
    },
  },
};
</script>
