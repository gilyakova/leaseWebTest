<template>
  <form id="token_form" method="POST" class="panel panel-default" v-on:submit.prevent="generateToken">
    <div class="panel-body">
      <div class="alert alert-danger" v-if="errors" role="alert">
        {{errors}}
      </div>

      <input type="hidden" name="_token" v-model="csrfToken" />
      <labeL>Description</labeL>
      <input type="text" required class="form-control mb-3" name="description" v-model="description" />
      <input type="hidden" name="copy" v-model="copy" />
      <input type="hidden" name="id" v-model="id" />


      <div class="card border-success mb-3">
        <div class="card-header">
          Allowed IP addresses and domains
          <small>(delimiter: ",")</small>
        </div>
        <div class="card-body text-success">
          <textarea v-model="whiteIP" class="form-control"></textarea>
        </div>
      </div>
      <div style="max-width:100%;overflow: auto;" v-if="token">
        <button type="button" class="btn btn-info btn-sm" @click="copyTokenText">Copy token</button>
        <textarea style="opacity:0;height:0;width:0;" id="copy-token">{{token}}</textarea>
        {{token}}
      </div> <!-- TODO Add button Copy -->
      <div class="alert alert-danger" v-if="errors" role="alert">
        {{errors}}
      </div>
      <button type="button"class="btn btn-warning" @click="closeForm">Close</button>
      <button type="submit" class="btn btn-primary">Save and generate token</button>
    </div>
  </form>
</template>

<script>

  export default {
    data: function() {
      return {
        id: null,
        scopesDeny: [],
        scopesAllow: [],
        locationsDeny: [],
        locationsAllow: [],
        csrfToken: Laravel.csrfToken,
        whiteIP: "",
        description: "",
        token: "",
        copy: 0,
        errors: ""
      }
    },
    created: function() {
        axios.get('/scopes')
          .then(response => (
            this.scopesDeny = response.data.scopes,
            this.locationsDeny = response.data.locations,
            this.loadItem()
          ));
    },
    methods: {
      copyTokenText: function() {
        $('#copy-token').select();
        document.execCommand("copy");
      },
      generateToken: function() {
        axios({
          method: 'post',
          url: 'generateToken',
          data: {
              scopesAllow: this.scopesAllow,
              locationsAllow: this.locationsAllow,
              csrfToken: this.csrfToken,
              whiteIP: this.whiteIP,
              description: this.description,
              id: this.id,
              copy: this.copy
          }
        })
        .then(response => { 
          if (response.data.result == 'OK') {
            this.token = response.data.token;
            this.id = response.data.id;
            this.$parent.updateList();
            this.copy = 0;
          } else {
            this.errors = response.data.message;
          }
        })
        .catch(error => {
          alert('Unknowen error');
        });
      },
      closeForm: function() {
        this.$parent.closeForm();
      },
      loadItem: function() {
        if (this.$parent.currentToken) {
          if (this.$parent.copyToken == 0) {
            this.id = this.$parent.currentToken.id;
            this.token = this.$parent.currentToken.token;
          }
          this.copy = this.$parent.copyToken;
          this.whiteIP = this.$parent.currentToken.white_ip;
          this.description = this.$parent.currentToken.name;

          let scopes = JSON.parse(this.$parent.currentToken.scopes);
          for (var i = 0; i < scopes.length; ++i) {
            let key = scopes[i];
            var found = false;
            for (var k = 0; k < this.scopesDeny.length; ++k) {
              if (this.scopesDeny[k].code == key) {
                this.scopesAllow.push(this.scopesDeny[k]);
                this.scopesDeny.splice(k, 1);
                found = true;
                break;
              }
            }
            if (found == false) {
              for (var k = 0; k < this.locationsDeny.length; ++k) {
                if (this.locationsDeny[k].code == key) {
                  this.locationsAllow.push(this.locationsDeny[k]);
                  this.locationsDeny.splice(k, 1);
                  break;
                }
              }
            }
            found = false;
          }
        }
      }
    },
    components: {
      draggable
    },
  }
</script>
<style>
  .dragArea {
    min-height: 10px;
  }
  .dragArea .badge {
    cursor: pointer;
  }
  .card {
    height: 92%;
  }
</style>