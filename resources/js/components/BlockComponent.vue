<template>
  <div class="row">
    <div class="col-md-6">
    <div class="form-group">
      <label>Select District: <span class="m-l-5 text-danger">*</span></label>
      <select class="form-control" v-model="district" @change="getBlocks()" name="district_id">
        <option value="0">Select District</option>
        <option v-for="data in districts" :value="data.id" v-bind:key="data.id">
          {{ data.district }}
        </option>
      </select>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
      <label>Select Block: <span class="m-l-5 text-danger">*</span></label>
      <select class="form-control" v-model="block" name="block_id">
        <option value="0">Select Block</option>
        <option v-for="data in blocks" :value="data.id" v-bind:key="data.id">
          {{ data.block }}
        </option>
      </select>
    </div>
</div>
</div>
</template>
   
<script>
export default {
  name: "block-attributes",
  props: ['clientid'],
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      district: 0,
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
           //console.log();
        }.bind(this)
      );
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
    }
  },
  created: function () {
    this.getDistricts();
    this.getAttributes();

    if(this.clientid != 0) {
        console.log('Result Expected');
        this.loadBlocks();
     }
  },
  mounted() {
     //console.log(this.seldistrict);

     //this.district = 5;
     this.getAttributes();
     if(this.clientid != 0) {
        console.log('Result Expected');
     }
  },
};
</script>