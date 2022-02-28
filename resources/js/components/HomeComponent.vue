<template>
  <div class="container ">
    <div class="card ">
      <div class="card-header text-white bg-dark">
        <div class="row">
          <div class="col-8">
            <h1>Furnitures</h1>
          </div>
          <div class="col-4 my-2">
            <form class="d-flex" @submit.stop.prevent="searchClick">
              <input
                class="form-control me-2"
                type="search"
                v-model="searchText"
                placeholder="ค้นหาสินค้า"
                aria-label="Search"
                required
              />
              <button class="btn btn-success" type="submit">ค้นหา</button>
            </form>
          </div>
        </div>
      </div>
      <div class="card-body text-dark bg-light">
        <div class="container-sm">
          <div class="row">
            <div class="col-4 mt-5 d-flex justify-content-center" v-for="fur in furnitures" :key="fur.id">
              <div class="card " style="width: 18rem">
                <img :src="fur.image" class="card-img-top" />
                <div class="card-body">
                  <h5 class="card-title">{{ fur.name }}</h5>
                  <p class="card-text text-truncate">
                    {{ fur.description }}
                  </p>
                  
                  <button type="button" class="btn btn-warning my-2 ">Buy</button>
                  
                  <button
                    class="btn btn-dark "
                    data-bs-toggle="modal"
                    data-bs-target="#readModal"
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
    </div>

    <!-- ข้างใน -->
    <div
      class="modal fade "
      id="readModal"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="readLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog ">
        <div class="modal-content"> 
          <div class="modal-header">
            <h5 class="modal-title" id="readLabel">{{ furName }}</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <img :src="furImg" class="img-fluid" />
            <p>{{ furDes }}</p>
            <h3>ราคา {{ furPrice }} บาท</h3>
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

      furName: null,
      furImg: null,
      furPrice: null,
      furDes: null,

      searchText: null
    };
  },
  mounted() {
    this.getFurnitures();
  },
  methods: {
    
    getFurnitures() {
      axios
        .get("/api/product")
        .then((data) => {
          this.furnitures = data.data.products;
        })
        .catch((err) => console.log(err));
    },

    
    readModal(id) {
      axios.get(`/api/product/show/${id}`).then((data) => {
        this.furName = data.data.name;
        this.furImg = data.data.image;
        this.furPrice = data.data.price;
        this.furDes = data.data.description;
      });
    },
   searchClick() {
      window.location.replace(`/search/${this.searchText}`);
    },

  },
};
</script>
