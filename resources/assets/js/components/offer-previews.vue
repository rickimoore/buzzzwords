<template>
    <ul class="log--results">
        <li class="result" v-for="offer in offers">
            <a :href="offer.link" @click.prevent="logView(offer)" target="_blank">
                <div class="result--header">
                    <p>{{offer.site}}</p>
                    <span class="meta--data">{{offer.views}} views</span>
                </div>
                <div class="result--data">
                    <h2>{{offer.title}}</h2>
                    <p>{{offer.description | toShortPreview}}</p>
                </div>
                <div class="result--footer">
                    <div class="footer--company">
                        <span>{{offer.company}}</span> - <span>{{offer.location}}</span>
                    </div>
                    <div class="footer--date">
                        <span class="meta--data">{{offer.updated_at | dateToMoment}}</span>
                    </div>
                </div>
            </a>
        </li>
    </ul>
</template>
<script>
    export default {
      props: ['offers'],
      methods: {
        logView: function ($offer) {
          $offer.views = ++$offer.views;
          setTimeout(() => window.open($offer.link, '_blank'), 500);
          axios.put('/offer-backlog/' + $offer.id, $offer).then($result => {})
        },
      },
      filters: {
        dateToMoment: function ($date) {
          return moment($date).fromNow()
        },
        toShortPreview: function ($preview) {
          return $preview.slice(0, 200) + '...'
        }
      }
    }
</script>