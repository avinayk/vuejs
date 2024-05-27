<template>
  <router-view></router-view>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto">
        <a href="javascript:void(0)">Presento<span>.</span></a>
      </h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt=""></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li>
            <router-link to="/home" class="nav-link">Home</router-link>
          </li>

          <li>
            <router-link to="/product" class="nav-link">Products</router-link>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->
      <a
        href="javascript:void(0)"
        @click="logout"
        class="btn btn-danger text-white ml-1"
        >Logout
      </a>
      <div class="maindiv">
        <a
          @click="clicktoggle"
          title="Product Cart List"
          href="javascript:void(0)"
          class="ml-2"
          style="font-size: 22px"
          ><i class="fas fa-cart-plus"></i><span>{{ qty }}</span></a
        >
        <div class="bmodal" v-if="showModal">
          <b-modal title="Product Added" class="scrollheight">
            <div
              class="d-flex align-items-center"
              v-for="(carts, index) in cart"
              :key="index"
            >
              <div class="flex-shrink-0">
                <h6 class="text-start">{{ index + 1 }}.</h6>
                <div class="img-box-area">
                  <img :src="carts.image" alt="image" />
                </div>
              </div>
              <div class="flex-grow-1">
                <div class="d-flex flex-column gap-1 text-area-box">
                  <h2><strong>Product :</strong> {{ carts.name }}</h2>
                  <h4><strong>Price :</strong> ${{ carts.price }}</h4>
                  <h4><strong>Qty:</strong> {{ carts.number }}</h4>
                  <h4><strong>Total:</strong> ${{ carts.total }}</h4>
                </div>
              </div>
            </div>
            <hr />
            <div
              class="d-flex float-end flex-column gap-1 text-area-box"
              v-if="showModal"
            >
              <h5>Sub-total: ${{ subtotal }}</h5>
              <button
                class="btn btn-secondary"
                v-if="showModal"
                @click="toggleModals"
              >
                Close
              </button>
            </div>
          </b-modal>
        </div>
      </div>
    </div>
  </header>
  <section id="counts" class="counts">
    <h2>All Products</h2>
    <div class="row">
      <div class="container">
        <section id="cart">
          <article
            class="product"
            v-for="(product, index) in products"
            :key="index"
          >
            <header>
              <a class="remove">
                <img :src="product.image" alt="" />
              </a>
            </header>

            <div class="content">
              <h1>{{ index + 1 }}{{ product.name }}</h1>

              {{ product.description }}

              <div
                title="You have selected this product to be shipped in the color yellow."
                style="top: 0"
                class="color yellow"
              ></div>
            </div>

            <footer class="content">
              <span class="qt-minus" @click="prev(index, products)">-</span>
              <span class="qt">{{ product.number }}</span>
              <span class="qt-plus" @click="addmore(index, products)">+</span>
              <a href="javascript:void(0)"
                ><span
                  class="price addcart"
                  @click="addtocart(index, products, product)"
                  title="Add to Cart"
                  >Add to Cart</span
                ></a
              >
              <h2 class="full-price">$ {{ product.total }}</h2>

              <h2 class="price">${{ product.price }}</h2>
            </footer>
          </article>
        </section>
      </div>
    </div>
  </section>

  <!-- End Header -->
</template>

<script>
import axios from "axios";
export default {
  name: "App",
  data() {
    return {
      products: [],
      showModal: false,
      inCart: false,
      qty: "0",
      cart: [],
      cartss: [],
      subtotals: [],
      subtotal: "0",
      t: "0",
      to_t: "0",
      tt: "0",
      numbers: "1",
      finalsum: [],
    };
  },
  mounted() {
    this.getproductdata();
  },
  methods: {
    getproductdata() {
      const isAuthenticated = sessionStorage.getItem("users");

      if (isAuthenticated == null) {
        this.$router.push("/login");
        setTimeout(() => {
          location.reload();
        }, 1000);
      }
      const getuser = sessionStorage.getItem("users");
      axios
        .get("http://localhost/projects/vuejs/getproduct.php", {
          params: {
            getuser,
          },
        })
        .then((response) => {
          this.products = response.data;
          console.log("usererer");
        })
        .catch((error) => {
          console.log(error);
        });
    },
    clicktoggle() {
      this.showModal = true;
    },
    toggleModals() {
      this.showModal = false;
    },
    resetModal() {
      this.showModal = false;
      this.inCart = false;
    },
    logout() {
      sessionStorage.removeItem("users");
      this.$router.push("/login");
      setTimeout(() => {
        location.reload();
      }, 1000);
    },
    addmore(index, products) {
      var num = products[index].number++;
      var inc = num + 1;
      products[index].total = products[index].price * inc;
      var t = parseFloat(products[index].price);
      var to_t = parseFloat(this.subtotal);
      this.subtotal = parseFloat(t + to_t);
    },
    addtocart(index, products, product) {
      const checkid = "";
      let total = 0;
      for (let i = 0; i < this.cart.length; i++) {
        if (this.cart[i].id == product.id) {
          checkid.push("1");
        }
      }

      if (checkid == "") {
        this.cart.push(product);
        var n = this.numbers++;
        this.qty = n;
        for (let ii = 0; ii < this.cart.length; ii++) {
          total += parseFloat(this.cart[ii].price);
        }
        console.log(this.subtotal);
        console.log(total);
        this.cartss.push(product);
        //this.subtotal = this.products[index].price * n;

        this.subtotal =
          parseFloat(this.subtotal) + parseFloat(this.products[index].price);
        this.finalsum.push(this.products[index].price * n);
      }
    },
    prev(index, products) {
      var num_s = products[index].number;
      console.log(num_s);
      if (num_s > 1) {
        var inc = products[index].number--;
        console.log(inc);
        var ini = inc - 1;
        this.qty = inc;
        products[index].total = products[index].price * ini;
        this.subtotal = parseFloat(this.subtotal) - products[index].price;
        //var tt = parseFloat(this.subtotal);
        //var t = products[index].price;
      }
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
hr {
  background: gray;
}
b-modal.scrollheight {
  height: 200px;
  overflow-y: auto;
  display: block;
}
span.price.addcart {
  background: #a5d612 !important;
  color: white !important;
  font-weight: 900 !important;
}
.bmodal {
  position: absolute;
  min-width: 275px;
  right: 0;
  top: 34px;
  background: #fff;
  box-shadow: 0px 3px 6px #c9c9c9;
  padding: 10px;
}
.img-box-area {
  width: 127px;
  height: 100px;
  overflow: hidden;
}
.img-box-area img {
  object-fit: cover;
  width: 100%;
  height: 100%;
}
.text-area-box {
  text-align: left;
  padding: 0 10px;
}
.text-area-box h2 {
  font-size: 14px;
}
.text-area-box h4 {
  font-size: 14px;
}
.text-area-box h5 {
  font-size: 14px;
}
.maindiv {
  position: relative;
}
.subb {
  background: #e03a3c;
  border: 0;
  padding: 13px 32px;
  color: #fff;
  transition: 0.4s;
  border-radius: 4px;
}
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}

.clearfix {
  content: "";
  display: table;
  clear: both;
}

#site-header,
#site-footer {
  background: #fff;
}

#site-header {
  margin: 0 0 30px 0;
}

#site-header h1 {
  font-size: 31px;
  font-weight: 300;
  padding: 40px 0;
  position: relative;
  margin: 0;
}

a {
  color: #000;
  text-decoration: none;

  -webkit-transition: color 0.2s linear;
  -moz-transition: color 0.2s linear;
  -ms-transition: color 0.2s linear;
  -o-transition: color 0.2s linear;
  transition: color 0.2s linear;
}

a:hover {
  color: #53b5aa;
}

#site-header h1 span {
  color: #53b5aa;
}

#site-header h1 span.last-span {
  background: #fff;
  padding-right: 150px;
  position: absolute;
  left: 217px;

  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  -ms-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  transition: all 0.2s linear;
}

#site-header h1:hover span.last-span,
#site-header h1 span.is-open {
  left: 363px;
}

#site-header h1 em {
  font-size: 16px;
  font-style: normal;
  vertical-align: middle;
}

.container {
  font-family: "Open Sans", sans-serif;
  margin: 0 auto;
  width: 980px;
}

#cart {
  width: 100%;
}

#cart h1 {
  font-weight: 300;
}

#cart a {
  color: #53b5aa;
  text-decoration: none;

  -webkit-transition: color 0.2s linear;
  -moz-transition: color 0.2s linear;
  -ms-transition: color 0.2s linear;
  -o-transition: color 0.2s linear;
  transition: color 0.2s linear;
}

#cart a:hover {
  color: #000;
}

.product.removed {
  margin-left: 980px !important;
  opacity: 0;
}

.product {
  border: 1px solid #eee;
  margin: 20px 0;
  width: 100%;
  height: 195px;
  position: relative;

  -webkit-transition: margin 0.2s linear, opacity 0.2s linear;
  -moz-transition: margin 0.2s linear, opacity 0.2s linear;
  -ms-transition: margin 0.2s linear, opacity 0.2s linear;
  -o-transition: margin 0.2s linear, opacity 0.2s linear;
  transition: margin 0.2s linear, opacity 0.2s linear;
}

.product img {
  width: 100%;
  height: 100%;
}

.product header,
.product .content {
  background-color: #fff;
  border: 1px solid #ccc;
  border-style: none none solid none;
  float: left;
}

.product header {
  background: #000;
  margin: 0 1% 20px 0;
  overflow: hidden;
  padding: 0;
  position: relative;
  width: 24%;
  height: 195px;
}

.product header:hover img {
  opacity: 0.7;
}

.product header:hover h3 {
  bottom: 73px;
}

.product header h3 {
  background: #53b5aa;
  color: #fff;
  font-size: 22px;
  font-weight: 300;
  line-height: 49px;
  margin: 0;
  padding: 0 30px;
  position: absolute;
  bottom: -50px;
  right: 0;
  left: 0;

  -webkit-transition: bottom 0.2s linear;
  -moz-transition: bottom 0.2s linear;
  -ms-transition: bottom 0.2s linear;
  -o-transition: bottom 0.2s linear;
  transition: bottom 0.2s linear;
}

.remove {
  cursor: pointer;
}

.product .content {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 140px;
  padding: 0 20px;
  width: 75%;
}

.product h1 {
  color: #53b5aa;
  font-size: 25px;
  font-weight: 300;
  margin: 17px 0 20px 0;
}

.product footer.content {
  height: 50px;
  margin: 6px 0 0 0;
  padding: 0;
}

.product footer .price {
  background: #fcfcfc;
  color: #000;
  float: right;
  font-size: 15px;
  font-weight: 300;
  line-height: 49px;
  margin: 0;
  padding: 0 30px;
}

.product footer .full-price {
  background: #53b5aa;
  color: #fff;
  float: right;
  font-size: 22px;
  font-weight: 300;
  line-height: 49px;
  margin: 0;
  padding: 0 30px;

  -webkit-transition: margin 0.15s linear;
  -moz-transition: margin 0.15s linear;
  -ms-transition: margin 0.15s linear;
  -o-transition: margin 0.15s linear;
  transition: margin 0.15s linear;
}

.qt,
.qt-plus,
.qt-minus {
  display: block;
  float: left;
}

.qt {
  font-size: 19px;
  line-height: 50px;
  width: 70px;
  text-align: center;
}

.qt-plus,
.qt-minus {
  background: #fcfcfc;
  border: none;
  font-size: 30px;
  font-weight: 300;
  height: 100%;
  padding: 0 20px;
  -webkit-transition: background 0.2s linear;
  -moz-transition: background 0.2s linear;
  -ms-transition: background 0.2s linear;
  -o-transition: background 0.2s linear;
  transition: background 0.2s linear;
}

.qt-plus:hover,
.qt-minus:hover {
  background: #53b5aa;
  color: #fff;
  cursor: pointer;
}

.qt-plus {
  line-height: 50px;
}

.qt-minus {
  line-height: 47px;
}

#site-footer {
  margin: 30px 0 0 0;
}

#site-footer {
  padding: 40px;
}

#site-footer h1 {
  background: #fcfcfc;
  border: 1px solid #ccc;
  border-style: none none solid none;
  font-size: 24px;
  font-weight: 300;
  margin: 0 0 7px 0;
  padding: 14px 40px;
  text-align: center;
}

#site-footer h2 {
  font-size: 24px;
  font-weight: 300;
  margin: 10px 0 0 0;
}

#site-footer h3 {
  font-size: 19px;
  font-weight: 300;
  margin: 15px 0;
}

.left {
  float: left;
}

.right {
  float: right;
}

.type {
  background: #fcfcfc;
  font-size: 13px;
  padding: 10px 16px;
  left: 100%;
}

.type,
.color {
  border: 1px solid #ccc;
  border-style: none none solid none;
  position: absolute;
}

.color {
  width: 40px;
  height: 40px;
  right: -40px;
}

.red {
  background: #cb5a5e;
}

.yellow {
  background: #f1c40f;
}

.blue {
  background: #3598dc;
}

.minused {
  margin: 0 50px 0 0 !important;
}

.added {
  margin: 0 -50px 0 0 !important;
}
</style>
