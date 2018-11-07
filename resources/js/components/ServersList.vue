<template>
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
            Server's list
            <button @click="addServer()" class="float-sm-right btn btn-primary">Add new</button>
        </div>
        <div class="panel-body table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Description</th>
                <th scope="col">Valid</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in items" v-bind:class="[item.valid ? 'table-danger' : '']">
                <td>{{item.name}}</td>
                <td>{{item.valid?'Yes':'No'}}</td>
                <td>
                  <a href="#" @click="addModule(item)" class="text-primary">add module</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <ServerForm v-if="showServerForm"></ServerForm>
    </div>
  </div>
</div>
</template>
<script>
  import TokenForm from './ServerForm'

  export default {
    data: function() {
        return {
          showServerForm: false,
          items: [],
          currentServer: null,
        }
    },
    components: {
      ServerForm
    },
    created: function() {
      this.updateList();
    },
    methods: {
      addServer: function () {
        this.closeForm();
        this.$nextTick(function () {
          this.currentServer = null;
          this.showServerForm = true;
        })
      },
      updateList() {
        axios.get('/api/server/list')
          .then(response => (
            this.items = response.data.list
          ));
      },
      closeForm: function() {
        if (this.currentServer == true) {
          if (confirm("Close current form?")) {
            this.currentServer = false;
          }
        }
      }
    }
  }
</script>