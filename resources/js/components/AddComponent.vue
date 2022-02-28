<template>
<body class="bg-secondary ">
  <div class="container ">
    <div class="row justify-content-center ">
      <div class="col-md-8 ">
        <div class="card">
          <div class="card-header">
            <div class="row ">
              <div class="col">
                <h1>เพิ่มสินค้า</h1>
              </div>
              <form @submit.stop.prevent="addProduct()">
                <label for="name">ชื่อสินค้า</label>
                <input
                  type="text"
                  id="name"
                  v-model="productName"
                  class="form-control"
                  required
                />
                <label for="img">Url รูปภาพ</label>
                <input
                  type="text"
                  id="img"
                  v-model="productImg"
                  class="form-control"
                  required
                />
                <label for="price">ราคา</label>
                <input
                  type="number"
                  id="price"
                  v-model="price"
                  class="form-control"
                  required
                />
                <label for="des">ข้อมูลสินค้า</label>
                <textarea
                  id="des"
                  v-model="description"
                  rows="3"
                  class="form-control"
                  required
                />
                <div class="mt-3 text-end">
                  <button type="reset" class="btn btn-danger mr-2">
                    ยกเลิก
                  </button>
                  <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
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
          alert("เพิ่มสินค้าเรียบร้อย");
          window.location.reload();
        })
        .catch((err) => alert(err));
    },
  },
};
</script>
