import 'es6-promise/auto'

import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);


export const store = new Vuex.Store({
  state: {
    classifications: [],
    history: [],
    bin: [],
    offers: '',
    isActiveModal: false,
    modal: ''
  },
  mutations: {
    appendToClassList (state, grade) {
      state.classifications.push(grade)
    },
    appendToHistory (state, data) {
      state.history.push(data)
    },
    clearClassList (state) {
      state.classifications = [];
    },
    clearBin (state) {
      state.bin = [];
    },
    appendToBin (state, data) {
      state.bin.push(data)
    },
    revealModal (state, data) {
      state.modal = data;
      setTimeout(() => {
        state.isActiveModal = true;
      }, 500);
    },
    destroyModal (state, data) {
      state.isActiveModal = false;
      setTimeout(() => {
        state.modal = data;
      }, 500);
    },
    setOffers (state, data) {
      state.offers = data;
    },
    removeOffer (state, offer) {
      for(var i = 0; i < state.offers.length; i++){
        if(state.offers[i].id === offer){
          state.offers.splice(i, 1);
        }
      }
    }
  }
});




