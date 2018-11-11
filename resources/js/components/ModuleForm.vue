<template>
  <form id="module-form" method="POST" class="panel panel-default" v-on:submit.prevent="save">
    <div class="panel-heading">
      <span class="main-title">New module</span>
      <button type="button"class="btn btn-warning float-sm-right btn-sm" @click="closeForm">X</button>
    </div>
    <div class="panel-body">
      <div class="alert alert-danger" v-if="errors" role="alert">
        <ul v-for="error in errors">
          <li>{{ error }}</li>
        </ul>
      </div>
      <input type="hidden" class="form-control mb-3" name="server_id" v-model="serverId" />

      <labeL>*Type</labeL>
      <select v-model="type" required class="form-control mb-3" >
        <option v-for="item in types" v-bind:value="item">
          {{ item }}
        </option>
      </select>

      <labeL>*Size (GigaByte)</labeL>
      <input type="number" required min="1" class="form-control mb-3" name="size" v-model="size" />

      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
</template>

<script>

  export default {
    data: function() {
      return {
        serverId: null,
        type: "",
        size: 1,
        types: [],
        errors: false
      }
    },
    created: function() {
      this.serverId = this.$parent.currentServer.id;
      axios.get('/api/module/types')
      .then(response => (
        this.types = response.data.data
      ))
      .catch(error => {
        alert('Unknown error');
      });
    },
    methods: {
      save: function() {
        axios({
          method: 'post',
          url: '/api/module/add',
          data: {
              serverId: this.serverId,
              type: this.type,
              size: this.size
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