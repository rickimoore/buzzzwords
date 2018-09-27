<template>
    <div class="analytic--container container">
        <div class="analytic--banner">
            <h1><span>{{weightedBucket ? weightedBucket.length : 0}}</span> / <span>{{bucketCount}}</span></h1>
            <button @click="clearCacheHistory" class="bzz--btn clear-wBorder--btn">Clear history</button>
        </div>
        <ul v-if="weightedBucket" class="analytic--group">
            <li v-for="(item, $index) in truncatedBucket"
                :class="{'highlight': weightedBucket.length > 9 && $index < 9, 'important': weightedBucket.length > 19 && $index > 9 && $index < 19}"
                :key="$index">
                <div class="group--word">{{item.word}}</div>
            </li>
        </ul>
        <button class="bzz--btn" v-if="weightedBucket && weightedBucket.length > count" @click="count += count">See More ( {{truncatedBucket.length}} /  {{weightedBucket.length}} )</button>
    </div>
</template>
<script>
    export default {
      props: ['data'],
      data: function () {
        return {
          count: 40
        }
      },
      computed: {
        bucket: function () {
          var $bucket = {};

          if(this.data.length === 0)
          {
            return 'empty';
          }

          for(var $i = 0; $i < this.data.length; $i++){
            var $group = this.data[$i];
            for(var $item in $group){
              if(!$bucket.hasOwnProperty($item)){
                  $bucket[$item] = $group[$item];
              } else {
                $bucket[$item] += $group[$item];
              }
            }
          }

          return $bucket;
        },
        bucketCount: function () {
          var count = 0;

          if(this.bucket === 'empty') {
            return 0;
          }

          for (var k in this.bucket) if (this.bucket.hasOwnProperty(k)) ++count;

          return count;
        },
        weightedBucket: function () {
          var $documents = this.data.length;
          var tfIdfList = {};

          for(var i = 0; i < $documents; i++) {
            for(var key in this.data[i]) {
              if(!tfIdfList.hasOwnProperty(key)) {
                var docFrequency = this.data.filter(($document) => { return $document.hasOwnProperty(key)});
                tfIdfList[key] = this.data[i][key] * Math.log($documents / docFrequency.length)
              }
            }
          }
          return Object.keys(tfIdfList).map((key) => { return {word: key, weight: tfIdfList[key]}}).sort(function(a,b){return b.weight - a.weight});
        },
        truncatedBucket: function () {
          return this.weightedBucket && this.weightedBucket.length > 0 ? this.weightedBucket.slice(0, this.count) : this.weightedBucket
        }
      },
      methods: {
        clearCacheHistory: function () {
          this.$store.commit('clearClassList', true);
          this.$store.commit('clearBin', true);
        }
      }
    }
</script>