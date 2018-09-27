<template>
    <div class="crawler-input--container">
        <div class="crawler--cta">
            <h1>Buzzwords are important for catching attention, so we will help you find yours.</h1>
            <p v-if="isError">Please enter valid url.</p>
        </div>
        <div class="crawler--input-group">
            <input type="text" placeholder="Paste your job offer here..." @paste="addToBucket" v-model="form.link">
            <button class="submit--btn" :class="{'active--button': bucket.length > 0 || form.link}" @click="submitBucket">submit</button>
            <transition name="shortSlideUp">
                <div v-if="isTut" class="crawler--tut">
                    <img src="/image/tutorials/giphy--buzz.gif" alt="tut">
                    <div class="tut--info">
                        <p>Get started by pasting your offer below...</p>
                        <button @click="closeTut" class="bzz--btn">Understood</button>
                        <div class="caret"></div>
                    </div>
                </div>
            </transition>
        </div>
        <div class="crawler--input-list">
            <div class="input--item" v-for="link in bucket">
                <div class="item--link">{{link.slice(0, 25) + '...'}}</div>
                <div class="item--option">
                    ( x )
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['tutPriority'],
        data: function () {
          return {
            form: {
              link: ''
            },
            isTut: false,
            bucket: [],
            isError: false
          }
        },
      watch: {
        'tutPriority': function (nV) {
          this.checkAndRelease(nV);
        },
        'form.link': function (nV) {
          if(nV && this.isTut){
            this.closeTut();
          }
        }
      },
      mounted() {
        setTimeout(() => this.checkAndRelease(this.tutPriority), 1000);
      },
      methods: {
        checkAndRelease: function ($modal) {
          var $tutCookie = this.$cookie.get('seen-tut');
          if(!$modal && !$tutCookie){
            setTimeout(() => this.isTut = true, 500);
          }
        },
        submitBucket: function () {
          this.bucket.forEach(($item) => {
            this.submitForm($item);
          })
        },
        submitForm: function ($link) {
          this.isError = false;
          if(!this.isUrl($link)){
            return this.isError = true;
          }

          let indexHistory = this.isInHistory($link);
          if(indexHistory !== null){
            return this.persistFromHistory(indexHistory)
          }
          
          
            axios.post('/analyze', {link: $link}).then((response) => {
              let $data = response.data.data;

              if(response.data.status === 'success') {

                let count = this.$store.state.history.length;

                this.$store.commit('appendToHistory', {'place': count, 'link': $link, 'data': $data});
                this.$store.commit('appendToClassList', $data);
                this.$store.commit('appendToBin', $link)

                this.bucket.splice(this.bucket.findIndex(($item) => $item === $link), 1)
              }

            }).catch(function (error) {
              console.log('error recieved', error)
            })
        },
        addToBucket: function () {
          setTimeout(() => {
            if(this.bucket.indexOf(this.form.link, 0) > -1){
              return this.form.link = '';
            }
            this.bucket.push(this.form.link);
            this.form.link = '';
          }, 500);
        },
        persistFromHistory: function (index) {
          let history = this.$store.state.history[index];

          if(this.$store.state.bin.indexOf(history.link) === -1) {
            this.$store.commit('appendToClassList', history.data)
            this.$store.commit('appendToBin', history.link)
          }

          this.form.link = '';
        },
        isInHistory: function (link) {
          let isPersisted = null;
          let $history = this.$store.state.history;

          if($history.length > 0) {
            for (var i = 0; i < $history.length; i++) {
              if($history[i].link === link) {
                return i;
              }
            }
          }

          return isPersisted;
        },
        isUrl: function isURL(str) {
          var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
            '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+ // domain name
            '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
            '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
            '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
            '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
          return pattern.test(str);
        },
        closeTut: function () {
          this.isTut = false;
          this.$cookie.set('seen-tut', true, 365);
        }
      }
    }
</script>
