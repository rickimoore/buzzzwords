<template>
    <div class="container">
        <div class="analytic--banner">
            <h1><span>{{orderedBucket ? orderedBucket.length : 0}}</span> / <span>{{bucketCount}}</span></h1>
            <button @click="clearCacheHistory" class="bzz--btn clear-wBorder--btn">Clear history</button>
        </div>
        <ul v-if="orderedBucket" class="analytic--group">
            <li v-for="(item, $index) in truncatedBucket"
                :class="{'highlight': orderedBucket.length > 9 && $index < 9, 'important': orderedBucket.length > 19 && $index > 9 && $index < 19}"
                :key="$index">
                <div class="group--word">{{item.word}}</div> <div class="group--count">{{item.count}}</div></li>
        </ul>
        <button class="bzz--btn" v-if="orderedBucket && orderedBucket.length > count" @click="count += count">See More ( {{truncatedBucket.length}} /  {{orderedBucket.length}} )</button>
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
        orderedBucket: function () {
          let self = this;
          if(this.bucket === 'empty') {
            return null;
          }


          var $filteredBucket = [];

          for(var key in this.bucket) {
            if(this.bucket[key] > 2) {
              $filteredBucket.push({word: key, count: this.bucket[key]})
            }
          }

          return $filteredBucket.sort(function(a,b){return b.count - a.count})
        },
        truncatedBucket: function () {
          return this.orderedBucket && this.orderedBucket.length > 0 ? this.orderedBucket.slice(0, this.count) : this.orderedBucket
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