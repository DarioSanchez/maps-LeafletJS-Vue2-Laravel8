<template>
  <div id="app">
    <l-map
      @click="onMapClick"
      ref="myMap"
      style="width: 100%; height: 100%"
      :zoom="10"
      :center="mapCenter"
    >
      <l-tile-layer
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        attribution="http://osm.org/copyright"
      ></l-tile-layer>
      <custom-marker
        v-for="(marker, i) in activityMarkers"
        :key="`activity-marker-${i}`"
        :marker="marker"
        @click.native="toggleInfo(marker)"
        alignment="top"
      >
        <div class="activity-info" v-if="marker.displayInfo">
         <ul>
           <li>Name: {{marker.name}}</li>
           <li>Owner: {{marker.owner}}</li>
           <li>Address: {{marker.address}}</li>
           <li>Latitud: {{marker.lat}}</li>
           <li>Longitud: {{marker.lng}}</li>
         </ul>
        </div>
        <div class="activity-marker-wrapper">
          <img class="activity-marker-type" :src="marker.type" />
        </div>
        <img class="activity-marker" src="/marker-1.png" />
      </custom-marker>

      <custom-marker
        v-for="(marker, i) in markers"
        :key="marker._id"
        :marker="marker"
        :alignment="marker.alignment"
        @click.native="deleteMarker(i)"
      >
        <weather-widget v-if="marker.weather" :coords="marker" />
        <img
          :class="animation"
          v-else
          :title="JSON.stringify(marker)"
          class="icon-sm"
          :src="src"
          height="45"
        />
      </custom-marker>
    </l-map>
  </div>
</template>

<script>
import CustomMarker from 'vue-leaflet-custom-marker'
import { LMap, LTileLayer } from 'vue2-leaflet'
export default {
  name: 'app',
  components: {
    CustomMarker,
    LMap,
    LTileLayer
  },
  data () {
    return {
      batchCount: 10,
      html: '<center><h2>This is <u>live</u> html marker 🔥</h2></center> <iframe width="330" height="170" src="https://www.youtube.com/embed/RySHDUU2juM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
      infinite: true,
      selectedAnimation: '',
      zA: 50,
      zB: 51,
      testText: '',
      markerCenter: {
        lat: 50.6272265,
        lng: 3.0571581
      },
      mapCenter: {
        lat: 50.6272265,
        lng: 3.0571581
      },
      addWeather: false,
      addMode: false,
      markers: [],
      ids: 0,
      alignment: 'center',
      animations: require('./animations.json'),
      batchMarkers: [],
      tools: true,
      activityMarkers: [
        {
          displayInfo: true,
          lat: 42.5511,
          lng: 16.4236,
          type: 'badmington.png'
        },
        {
          displayInfo: false,
          lat: 50.5,
          lng: 2.3,
          type: 'golf.png'
        },
        {
          displayInfo: false,
          lat: 50.8,
          lng: 2.8,
          type: 'ping-pong.png'
        },
        {
          displayInfo: false,
          lat: 50.2,
          lng: 2.7,
          type: 'rugby.png'
        },
        {
          displayInfo: false,
          lat: 50.3,
          lng: 2.3,
          type: 'tennis.png'
        }
      ]
    }
  },
  created() {
this.stations()
  },
  computed: {
    animation () {
      const infinite = this.infinite ? 'infinite' : ''
      return `animated ${infinite} ${this.selectedAnimation}`
    },
    src () {
      return this.testText ? this.testText : '/logo.png'
    }
  },
  methods: {
    stations() {
      this.$http.get(process.env.API_BACKEND + "/api/v01/stations/localization").then((response) => {
        this.activityMarkers = response.data;
        console.log(this.activityMarkers);
      })
    },
    toggleInfo (marker) {
      marker.displayInfo = !marker.displayInfo
    },
    left () {
      this.markerCenter = {
        lng: this.markerCenter.lng - 0.1,
        lat: this.markerCenter.lat
      }
    },
    right () {
      this.markerCenter = {
        lng: this.markerCenter.lng + 0.1,
        lat: this.markerCenter.lat
      }
    },
    displayTools (value) {
      this.tools = value
    },
    deleteMarker (i) {
      this.markers.splice(i, 1)
    },
    onMapClick (event) {
      console.log(event,this.addMode);
      if (this.addMode) {
        this.markers.push({
          _id: this.ids++,
          lat: event.latlng.lat,
          lng: event.latlng.lng,
          weather: this.addWeather,
          alignment: this.alignment
        })
        this.addMode = false
      }
    },
    addbatch () {
      this.batchMarkers = []
      for (let i = 0; i < this.batchCount; i++) {
        this.batchMarkers.push({
          lat: `48.1${String(parseInt(Math.random() * 100000))}`,
          lng: `-1.7${String(parseInt(Math.random() * 100000))}`
        })
      }
      this.markerCenter = {
        lat: 48.1030572,
        lng: -1.7065389
      }
    }
  }
}
</script>

<style>
@import "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css";
html,
body,
#app,
.vue-map-container {
  height: 100%;
  padding: 0px;
  margin: 0px;
}
* {
  font-family: "Kosugi Maru", sans-serif;
  color: #444;
}

button {
  color: #484b49;
  margin: 10px;
  border-radius: 5px;
  background-color: white;
  border: 1px solid #999;
  font-size: 1.05em;
  padding-right: 10px;
  padding-left: 10px;
  padding-top: 5px;
  padding-bottom: 5px;
}

.live-html {
  padding: 5px;
  border: 1px solid #aaa;
  border-radius: 4px;
  box-shadow: 3px 3px 3px grey;
  min-height: 200px;
  min-width: 200px;
  background-color: #fafafa;
}
.zindex {
  padding: 5px;
  border: 1px solid #aaa;
  border-radius: 4px;
  box-shadow: 3px 3px 3px grey;
  min-height: 100px;
  min-width: 100px;
  font-size: 1.3em;
}
.zindex-a {
  background-color: #eb7bff;
}
.zindex-b {
  background-color: #17e2b8;
}
.card {
  border-radius: 4px;
  background-color: #fafafa;
  padding: 15px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  border: 1px solid #ccc;
  min-height: 220px;
}
.input-group {
  float: right;
  margin-top: 25px;
  margin-right: 25px;
}
.icon {
  margin-left: 15px;
}
.alignment button {
  color: #eee;
  width: 80px;
  padding: 5px;
  border-radius: 5px;
  background-color: #47c765;
  border: none;
  margin: 2px;
  font-size: 0.8em;
}

.alignment {
  right: 10px;
  z-index: 1000;
  padding: 4px;
  top: 15px;
  border-radius: 5px;
}
.button {
  left: 50%;
  top: 15px;
  z-index: 100;
  color: white;
  padding: 5px;
  border-radius: 5px;
  margin-left: -12px;
}

.weather {
  top: 70px;
}

.icon-sm {
  padding: 3px;
  border-radius: 4px;
}
.animate-panel {
  padding: 7px;
  right: 10px;
  top: 150px;
  height: 100px;
  width: 250px;
  z-index: 100;
}

.live-editor {
  right: 10px;
  top: 270px;
  z-index: 1000;
  height: 100px;
  width: 250px;
  border: 1px solid #ccc;
}
.live-editor textarea {
  width: 100%;
  height: 100%;
}

.add-marker {
  padding: 8px;
  font-size: 1.3em;
}

.batch-cluster {
  right: 0px;
  top: 400px;
  width: 270px;
  height: 40px;
  border-radius: 5px;
  z-index: 100;
}

.card-tools {
  right: 5px;
  top: 5px;
  padding: 8px;
  background-color: #fafafa;
  border: 1px solid #bbb;
  border-radius: 8px;
  box-shadow: inset 0 0 10px #aaa;
  width: 270px;
  z-index: 1000;
  position: absolute;
}

.batch-cluster > input,
.batch-cluster > button {
  margin-left: 10px;
  margin-right: 10px;
}

.hide-tool {
  background-color: #fafafa;
  border: 1px solid #bbb;
  font-size: 1.3em;
}

.show-tool {
  position: absolute;
  top: 5px;
  right: 5px;
  background-color: #fafafa;
  border: 1px solid #bbb;
  font-size: 1.3em;
  z-index: 1000;
}
.image-wrapper,
.image-wrapper img {
  height: 75px;
}

.activity-marker {
  height: 80px;
  z-index: 20;
}
.activity-marker-type {
  height: 55px;
}
.activity-marker-wrapper {
  position: absolute;
  z-index: 25;
  text-align: center;
  width: 100px;
  top: 20px;
}
.activity-info {
  position: absolute;
  top: -80px;
  left: -60px;
  height: 18vh;
  font-size: 15px;
  width: 500px;
  border: 1px solid #aaa;
  background-color:white;
  border-radius: 8px;
}
</style>
