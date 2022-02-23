<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col">
                <h1>Furnitures Dashboard</h1>
              </div>
              <div class="col text-end mt-2">
                <a
                  href="/create"
                  class="btn btn-success"
                  data-bs-target="#addProduct"
                  >New Product</a
                >
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class="table-secondary">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Update</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="fur in furnitures" :key="fur.id">
                    <td>{{ fur.id }}</td>
                    <td width="150px">
                      <img :src="fur.image" class="img-fluid" width="100%" />
                    </td>
                    <td>{{ fur.name }}</td>
                    <td>{{ fur.price }}</td>
                    <td>{{ fur.description }}</td>
                    <td>
                      <button
                        class="btn btn-danger mt-2"
                        @click="delProduct(fur.id)"
                      >
                        Delete
                      </button>
                    </td>
                    <td>
                      <button
                        type="button"
                        @click="updateModal(fur.id)"
                        class="btn btn-primary mt-2"
                        data-bs-toggle="modal"
                        data-bs-target="#updateModal"
                      >
                        Update
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Update product -->
    </div>
    <div
      class="modal fade"
      id="updateModal"
      tabindex="-1"
      aria-labelledby="modal-header"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal-header">Update Game</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form @submit.stop.prevent="updateProduct()">
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
                <button type="reset" class="btn btn-danger mr-2">Cancel</button>
                <button type="submit" class="btn btn-success">Update</button>
              </div>
            </form>
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
      furnitures: [],

      // form
      productId: null,
      productName: null,
      productImg: null,
      price: null,
      description: null,
    };
  },
  mounted() {
    axios
      .get("/api/product")
      .then((data) => {
        this.furnitures = data.data.products;
      })
      .catch((err) => console.log(err));
  },
  methods: {
    // Update product function
    updateModal(id) {
      // API Get data from id and  from
      axios.get(`/api/product/show/${id}`).then((data) => {
        this.productId = data.data.id, 
        this.productName = data.data.name;
        this.productImg = data.data.image;
        this.price = data.data.price;
        this.description = data.data.description;
      });
    },
    updateProduct() {
      axios
        .post(`/api/product/update/${this.productId}`, {
          name: this.productName,
          image: this.productImg,
          price: this.price,
          description: this.description,
        })
        .then(() => {
          alert("Update product success.");
          window.location.reload();
        })
        .catch((err) => alert(err));
    },
    // Delete function
    delProduct(id) {
      const isComfirm = confirm("Are you sure to delete this game?");
      if (isComfirm == true) {
        axios
          .delete(`/api/product/delete/${id}`)
          .then(() => {
            alert("Delete product success.");
            window.location.reload();
          })
          .catch((err) => alert(err));
      }
    },
  },
};
</script>

