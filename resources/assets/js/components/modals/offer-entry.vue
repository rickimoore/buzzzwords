<template>
    <div class="container">
        <div class="entry--data">
            <div class="data--form-group">
                <md-field>
                    <label>Title:</label>
                    <md-input v-model="offer.title"></md-input>
                </md-field>
                <md-field>
                    <label>Owner:</label>
                    <md-input v-model="offer.company"></md-input>
                </md-field>
                <md-field>
                    <label>Location:</label>
                    <md-input v-model="offer.location"></md-input>
                </md-field>
                <md-field>
                    <label>Site:</label>
                    <md-input v-model="offer.site"></md-input>
                </md-field>
                <md-field>
                    <label>Description:</label>
                    <md-textarea v-model="offer.description" md-autogrow></md-textarea>
                </md-field>
            </div>
            <div class="data--footer">
                <div class="footer--info">
                    <a :href="offer.link" target="_blank">link: {{offer.link}}</a>
                </div>
                <div class="footer--options">
                    <button @click="updateOffer" class="bzz--btn">Update</button>
                    <button @click="deleteOffer(offer.id)" class="bzz--btn">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  var ClipboardJS = require('clipboard');
    export default {
      props: ['offer'],
      data: function () {
        return {
            error: false,
            isCopied: false
        }
      },
      mounted () {
        this.clipboard = new ClipboardJS('.clip-item');
      },
      methods: {
        updateOffer: function () {
          if(!this.validate(this.offer)){
            return
          }
          axios.put('/offer-backlog/' + this.offer.id, this.offer).then(result => {
            setTimeout(() => {
              this.$store.commit('destroyModal', null);
            }, 1000)
          }).catch(error => {
            console.log(error)
          })
        },
        deleteOffer: function ($offer) {
          axios.delete('/offer-backlog/' + $offer, {}).then((result) => {
            this.$store.commit('removeOffer', result.data)
            setTimeout(() => {
              this.$store.commit('destroyModal', null);
            }, 1000)
          })
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
        copyToBoard: function () {
          this.isCopied = true;
          let self = this;
          setTimeout(function () {
            self.isCopied = false;
          }, 1500);
        }
      }
    }
</script>