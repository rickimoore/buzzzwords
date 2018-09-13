<template>
    <div class="container">
        <div class="log--sectioned">
            <div class="log--list">
                <div class="log--search">
                    <input type="text" v-model="search">
                    <div class="filter--option">
                        <button @click="isActiveFilterOption = !isActiveFilterOption">Filter By: {{filter}}</button>
                        <transition name="fade">
                            <ul v-show="isActiveFilterOption" class="option--dropdown">
                                <li v-for="item in options" @click="setFilter(item)">{{item}}</li>
                            </ul>
                        </transition>
                    </div>
                    <div class="filter--direction">
                        <button @click="changeDirection">
                            <template v-if="!sort">
                                -
                            </template>
                            <template v-if="sort === 'asc'">
                                <img src="/image/icons/up.svg" alt="up">
                            </template>
                            <template v-if="sort === 'desc'">
                                <img src="/image/icons/down.svg" alt="down">
                            </template>
                        </button>
                    </div>
                </div>
                <ul class="search--results">
                    <li v-for="(offer, $index) in incompleteOffers" :key="$index" class="result"
                        @click="viewOffer(offer)"
                    >
                        <div class="result--info">
                            <span>{{offer.link.slice(0, 100) + '...'}}</span>
                        </div>
                        <div class="result--date">
                            <span>{{offer.created_at | dateToMoment}}</span>
                        </div>
                    </li>
                </ul>
            </div>
            <ul class="log--results">
                <li class="result" v-for="offer in completeOffers" @click="viewOffer(offer)">
                    <div class="result--header">
                        <p>{{offer.site}}</p>
                        <a :href="offer.link">Link</a>
                    </div>
                    <div class="result--data">
                        <h2>{{offer.title}}</h2>
                        <p>{{offer.description}}</p>
                    </div>
                    <div class="result--footer">
                        <div class="footer--company">
                            <span>{{offer.company}}</span> - <span>{{offer.location}}</span>
                        </div>
                        <div class="footer--date">
                            <span>{{offer.updated_at | dateToMoment}}</span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default {
      props:['offers'],
      data: function () {
        return {
          search: '',
          filter: 'link',
          isActiveFilterOption: false,
          options: ['company', 'location', 'site', 'title', 'link'],
          sort: null
        }
      },
      computed: {
        filteredSearch: function () {

          let $filteredArray = this.offers;

          if(this.search){
            $filteredArray = this.offers.filter(offer => offer[this.filter] && offer[this.filter].toLowerCase().includes(this.search.toLowerCase()));
          }

          if(this.sort) {
            return $filteredArray.sort( (a,b) => {
              return this.sort === 'desc'
                ? new Date(b.created_at) - new Date(a.created_at)
                : new Date(a.created_at) - new Date(b.created_at)
            });
          }

          return $filteredArray;
        },
        completeOffers: function () {
          if(!this.filteredSearch){
            return [];
          }
          return this.filteredSearch.filter($offer => this.validate($offer))
        },
        incompleteOffers: function () {
          if(!this.filteredSearch){
            return [];
          }
          return this.filteredSearch.filter($offer => !this.validate($offer))
        }
      },

      methods: {
        setFilter: function ($filter) {
          this.filter = $filter;
          this.isActiveFilterOption = false;
        },
        changeDirection: function () {
          if(!this.sort) {
            return this.sort = 'asc';
          }
          if(this.sort === 'asc') {
            return this.sort = 'desc';
          }
          this.sort = 'asc'
        },
        viewOffer: function (offer) {
          this.$store.commit('revealModal', offer);
        },
        validate: function (object) {
          if (object === null || object === '')
            return false;
          if (typeof object === 'object') {
            for (var key in object)
              if (key != 'webkitRelativePath' && !this.validate(object[key]))
                return false;
          }

          return true;
        },
      },
      filters: {
        dateToMoment: function ($date) {
          return moment($date).fromNow()
        }
      }
    }
</script>