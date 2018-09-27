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
    isSidePanelActive: false,
    modal: ''
  },
  mutations: {
    appendToClassList (state, grade) {
      state.classifications.push(grade)
    },
    togglePanel (state, data) {
      state.isSidePanelActive = data;
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




