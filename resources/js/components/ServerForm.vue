<template>
  <form id="server-form" method="POST" class="panel panel-default" v-on:submit.prevent="save">
    <div class="panel-heading">
      <span class="main-title">New server</span>
      <button type="button"class="btn btn-warning float-sm-right btn-sm" @click="closeForm">X</button>
    </div>
    <div class="panel-body">
      <div class="alert alert-danger" v-if="errors" role="alert">
        <ul v-for="error in errors">
          <li>{{ error }}</li>
        </ul>
      </div>

      <labeL>*Asset id</labeL>
      <input type="number" required maxlength="100" class="form-control mb-3" name="assetId" v-model="assetId" />

      <labeL>*Brand</labeL>
      <input type="text" required maxlength="100" class="form-control mb-3" name="brand" v-model="brand" />

      <labeL>*Name</labeL>
      <input type="text" required maxlength="100" class="form-control mb-3" name="name" v-model="name" />

      <labeL>*Price</labeL>
      <input type="number" required min="1" step="0.5" class="form-control mb-3" name="price" v-model="price" />

      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
</template>

<script>

  export default {
    data: function() {
      return {
        assetId: "",
        brand: "",
        name: "",
        price: 1,
        errors: false
      }
    },
    methods: {
      save: function() {
        axios({
          method: 'post',
          url: '/api/server/add',
          data: {
              assetId: this.assetId,
              brand: this.brand,
              name: this.name,
              price: this.price
          }
        })
        .then(response => { 
          this.$parent.updateList();
          this.closeForm(true);
          alert('Creating success');
        })
        .catch(error => {
          if (error.response.data.errors != undefined) {
            this.errors = error.response.data.errors;
          } else {
            alert('Unknown error');
          }
        });
      },
      closeForm: function(force) {
        this.$parent.closeForm(force);
      }
    }
  }
</script>