<template>
  <div class="row">
    <div class="col-md-7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <span class="main-title">Server's list</span>
          <button @click="addServer()" class="float-sm-right btn btn-primary">Add new</button>
        </div>
        <div class="panel-body table-responsive">
          <ul class="pagination" v-if="pagination.last_page>1">
            <li class="page-item" v-if="paginationLinks.first"><a class="page-link" href="#" @click="updateList(1)">First</a></li>
            <li class="page-item" v-if="paginationLinks.prev"><a class="page-link" href="#" @click="updateList(pagination.current_page-1)">Previous</a></li>
            <li class="page-item active"><a class="page-link">{{ pagination.current_page }}</a></li>
            <li class="page-item" v-if="paginationLinks.next"><a class="page-link" href="#" @click="updateList(pagination.current_page+1)">Next</a></li>
            <li class="page-item" v-if="paginationLinks.last"><a class="page-link" href="#" @click="updateList(pagination.last_page)">Last</a></li>
          </ul>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Description</th>
                <th scope="col">Modules list</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="item in items" v-bind:class="[currentServer && item.id == currentServer.id ? 'table-success' : (item.valid ? '' : 'table-danger')]">
                  <td>
                    Asset id: {{ item.assetId }}<br>
                    Brand: {{ item.brand }}<br>
                    Name: {{ item.name }}<br>
                    Price: {{ item.price }}
                  </td>
                  <td>
                    <ul>
                      <li v-for="module_item in item.modules">
                        {{ module_item.type }} {{ module_item.size }} GB
                        <button type="button" @click="deleteModule(module_item)" class="badge badge-danger ml-1">delete</button>
                      </li>
                    </ul>
                  </td>
                  <td>
                    <button type="button" @click="addModule(item)" class="btn btn-sm btn-info">+module</button>
                    <button type="button" @click="deleteServer(item)" class="btn btn-sm btn-danger">delete</button>
                  </td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <ServerForm v-if="showServerForm"></ServerForm>
      <ModuleForm v-if="showModuleForm"></ModuleForm>
    </div>
  </div>
</div>
</template>
<script>
  import ServerForm from './ServerForm'
  import ModuleForm from './ModuleForm'

  export default {
    data: function() {
        return {
          showServerForm: false,
          showModuleForm: false,
          items: [],
          currentServer: null,
          pagination: {
            current_page: 0,
            from: null,
            last_page: null,
            path: null,
            per_page: null,
            to: null,
            total: null
          },
          paginationLinks: {
            first: null,
            last: null,
            next: null,
            prev: null
          }
        }
    },
    components: {
      ServerForm,
      ModuleForm
    },
    created: function() {
      this.updateList();
    },
    methods: {
      addServer: function () {
        let closed = this.closeForm();
        if (closed) {
          this.$nextTick(function () {
            this.currentServer = null;
            this.showServerForm = true;
          })
        }
      },
      deleteServer: function (item) {
        if (confirm("Do you want to remove this server?")) {
          axios.delete('/api/server/' + item.id)
          .then(response => (
            this.updateList()
          ))
          .catch(error => {
            if (error.response.data.errors != undefined) {
              this.errors = error.response.data.errors;
            } else {
              alert('Unknown error');
            }
          });
        }
      },
      deleteModule: function (item) {
        if (confirm("Do you want to remove this module?")) {
          axios.delete('/api/module/' + item.id)
          .then(response => (
            this.updateList()
          ))
          .catch(error => {
            if (error.response.data.errors != undefined) {
              this.errors = error.response.data.errors;
            } else {
              alert('Unknown error');
            }
          });
        }
      },
      addModule: function (server) {
        let closed = this.closeForm();
        if (closed) {
          this.$nextTick(function () {
            this.currentServer = server;
            this.showModuleForm = true;
          })
        }
      },
      updateList(page) {
        if (page == undefined) {
          page = this.pagination.current_page;
        }
        axios.get('/api/server/list?page='+page)
        .then(response => (
          this.items = response.data.data,
          this.pagination = response.data.meta,
          this.paginationLinks = response.data.links
        ))
        .catch(error => {
          if (error.response.data.errors != undefined) {
            this.errors = error.response.data.errors;
          } else {
            alert('Unknown error');
          }
        });
      },
      closeForm: function(force) {
        if (force == true) {
          this.showServerForm = false;
          this.showModuleForm = false;
          this.currentServer = null;
        } else {
          if (this.showServerForm || this.showModuleForm) {
            if (confirm("Close current form?")) {
              this.showServerForm = false;
              this.showModuleForm = false;
              this.currentServer = null;
            } else {
              return false;
            }
          }
        }
        return true;
      }
    }
  }
</script>