<template>
    <div class="welcome modal">
        <md-steppers :md-active-step.sync="active">
            <md-step v-for="(step, $index) in steps" :key="$index" :id="step.label" :md-done.sync="steps.stat">
                <div class="slide--container" :class="'slide--' + $index">
                    <div v-html="step.message"></div>
                    <md-field v-if="step.label === 'signup'" :class="isValidEmail">
                        <label>Email Adress:</label>
                        <md-input v-model="form.email"></md-input>
                        <span class="md-error">Please enter a valid email!</span>
                    </md-field>
                </div>
                <div class="slide--footer">
                    <md-button class="md-raised md-primary bzz--btn" v-if="$index > 0" @click="unsetDone($index)">Back</md-button>
                    <md-button class="md-raised md-primary bzz--btn" @click="setDone($index)">{{step.label === 'last' ? 'Finish': 'Continue'}}</md-button>
                </div>
            </md-step>
        </md-steppers>
    </div>
</template>
<script>
    export default {
      data: function () {
        return {
          active: 0,
          steps: [
            {stat: false, label: 'fist', message: '<h1>Welcome to our beta, <br> buzzzwords!</h1>'},
            {stat: false, label: 'second', message: '<h1>We believe, <br> marketing yourself for job opportunities <br> can be a pleasant experience. <br><br>So we design tools to help guide you.</h1>'},
            {stat: false, label: 'third', message: '<h1>The purpose of this tool <br> is to help you <span class="underline">analyze job offers</span> <br> in order to <span class="underline">identify key/buzzwords</span> <br> that you can add to your resume.</h1>'},
            {stat: false, label: 'signup', message: '<h1>Stay updated with our latest developments <br> by joining our newsletter.</h1>'},
            {stat: false, label: 'last', message: '<h1>We appreciate your help. <br><br> Thank You!</h1>'}],
          form: {email: ''}
        }
      },
      computed : {
        isValidEmail: function () {
          var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return {'md-invalid': !re.test(String(this.form.email).toLowerCase()) && this.form.email};
        }
      },
      methods: {
        setDone: function ($index) {
          this.steps[$index].stat = true;

          if(++$index < this.steps.length) {
            return setTimeout(() => this.active = this.steps[$index].label, 200)
          }
          this.$cookie.set('welcome', true, 365);
          this.$store.commit('destroyModal', null);
        },
        unsetDone: function ($index) {
          this.steps[$index].stat = false;
          if(--$index >= 0) {
            return setTimeout(() => this.active = this.steps[$index].label, 200)
          }
        }
      }
    }
</script>