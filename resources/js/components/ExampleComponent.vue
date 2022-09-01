<template>
  <div>
    <div class="form-group">
      <label>Select District:</label>
      <select class="form-control" v-model="district" @change="getBlocks()" name="district_id">
        <option value="0">Select District</option>
        <option v-for="data in districts" :value="data.id" v-bind:key="data.id">
          {{ data.district }}
        </option>
      </select>
    </div>
    <div class="form-group">
      <label>Select Block:</label>
      <select class="form-control" v-model="block" name="block_id">
        <option value="0">Select Block</option>
        <option v-for="data in blocks" :value="data.id" v-bind:key="data.id">
          {{ data.block }}
        </option>
      </select>
    </div>
  </div>
</template>
   
<script>
export default {
  name: "location-attributes",
  props: ['clientid'],
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      district: '',
      distcode: '',
      districts: [],
      block: 0,
      blocks: [],
      attributes: [],

    };
  },
  
  methods: {
    getDistricts: function () {
      axios.get("/api/districts").then(
        function (response) {
          this.districts = response.data;
        }.bind(this)
      );
    },
    getBlocks: function () {
      this.block = 0;
      axios
        .get("/api/blocks", {
          params: {
            district_id: this.district,
          },
        })
        .then(
          function (response) {
            this.blocks = response.data;
          }.bind(this)
        );
    },
    getAttributes: function () {
      axios.get("/api/attributes", {
         params: {
           id: this.clientid
         },
      })
      .then(
        function (response) {
           this.district = response.data[0].district_id;
           this.distcode = response.data[0].district_id;
           this.loadBlocks();
           this.block = response.data[0].block_id;

        }.bind(this)
      );
      console.log(this.district);
    },
    loadBlocks: function () {      
      axios.get("/api/loadblocks", {
        params: {
           district_id: this.district,
        },
      }).then(
         function (response) {
           this.blocks = response.data;
         }.bind(this)
      );
      console.log('dist not showing here' + this.distcode);
    }
  },
  created: function () {
    this.getDistricts();
    this.getAttributes();

  },
};
</script>