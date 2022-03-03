<template>
  <div class="container ">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card text-white bg-dark">
          <div class="row">
            <div class="col-8">
              <h1>สินค้าที่พบ</h1>
            </div>
            <div class="col-12">
              <div class="card-body text-dark bg-light">
                <div class="row">
                  <div class="col-12">
                  </div>
                  <div class="col-12">
                    <div class="row my-5">
                      <div class="col-6" v-for="fur in furnitures" :key="fur.id">
                        <div class="card mb-3" style="max-width: 540px">
                          <div class="row g-0">
                            <div class="col-md-4">
                              <img
                                :src="fur.image"
                                class="img-fluid rounded-start"
                              />
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <h5 class="card-title">
                                  {{ fur.name }}
                                </h5>
                                <p class="card-text text-truncate mt-2">
                                  {{ fur.description }}
                                </p>
                                <h4 class="card-text mt-5">
                                  ราคา : {{ fur.price }} บาท
                                </h4>
                                <div class="card-text">
                                  <div class="d-grid gap-2 mt-5">
                                    <button
                                      type="button "
                                      data-bs-toggle="modal"
                                      data-bs-target="#buyGame"
                                      class="btn btn-dark btn-block"
                                      @click="readModal(fur.id)"
                                    >
                                      อ่านข้อมูลเพิ่มเติม
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div
                          class="modal fade"
                          id="buyGame"
                          data-bs-backdrop="static"
                          data-bs-keyboard="false"
                          tabindex="-1"
                          aria-labelledby="staticBackdropLabel"
                          aria-hidden="true"
                        >
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="G_name">
                                  {{ furName }}
                                </h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body text-center">
                                <img
                                  :src="furImg"
                                  class="img-fluid"
                                  style="max-height: 300px"
                                />
                              </div>
                              <div class="mb-3 text-center">
                                <label
                                  for="exampleFormControlTextarea1"
                                  class="form-label"
                                  >info</label
                                >
                                <textarea
                                  readonly
                                  class="form-control"
                                  id="exampleFormControlTextarea1"
                                  rows="3"
                                  v-model="furDes"
                                ></textarea>
                              </div>
                              <div class="text-center">
                                <h2>ราคา {{ furPrice }} บาท</h2>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
      searchText: null,
      furnitures: [],
      furId: "",
      furName: "",
      furImg: "",
      furPrice: "",
      furDes: "",
    };
  },
  created() {
    const route = window.location.href.split("/");
    this.searchText = route[route.length - 1];
  },
  mounted() {
    axios
      .get(`/api/product/search/${this.searchText}`)
      .then((data) => {
        this.furnitures = data.data;
      })
      .catch((err) => console.log(err));
  },
  methods: {
    readModal(id) {
      axios.get(`/api/product/show/${id}`).then((data) => {
        this.furId = data.data.id;
        this.furName = data.data.name;
        this.furImg = data.data.image;
        this.furPrice = data.data.price;
        this.furDes = data.data.description;
      });
    },
  },
};
</script>