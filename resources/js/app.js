import './bootstrap'
import Vue from 'vue'
import IdeaLike from './components/IdeaLike'
import LikeButton from './components/LikeButton'



Vue.component('Idea-Like', require('./components/IdeaLike.vue').default);
Vue.component('Like-Button', require('./components/LikeButton.vue').default);

new Vue({
  el: '#app',
  components: {
    IdeaLike,
    LikeButton
  }
})