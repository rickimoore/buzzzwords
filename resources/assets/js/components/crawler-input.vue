<template>
    <div class="crawler-input--container">
        <div class="crawler--cta">
            <h1>Buzzwords are important for catching attention, so we will help you find yours.</h1>
            <p v-if="isError">Please enter valid url.</p>
        </div>
        <div class="crawler--input-group">
            <input type="text" placeholder="Paste your job offer here..." v-model="form.link">
            <button :class="{'active--button': form.link}" @click="submitForm">submit</button>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
          return {
            form: {
              link: ''
            },
            isError: false
          }
        },
      methods: {
        submitForm: function () {
          this.isError = false;
          if(!this.isUrl(this.form.link)){
            return this.isError = true;
          }

          let indexHistory = this.isInHistory(this.form.link);
          if(indexHistory !== null){
            return this.persistFromHistory(indexHistory)
          }
          
          
            let self = this;
            axios.post('/analyze', this.form).then(function (response) {
              let $data = response.data.data;

              if(response.data.status === 'success') {

                let count = self.$store.state.history.length;

                self.$store.commit('appendToHistory', {'place': count, 'link': self.form.link, 'data': $data});
                self.$store.commit('appendToClassList', $data);
                self.$store.commit('appendToBin', self.form.link)

                self.form.link = '';
              }

            }).catch(function (error) {
              console.log('error recieved', error)
            })
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
        }
      }
    }
</script>
