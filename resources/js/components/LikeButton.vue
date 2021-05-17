<template>
    <button
        type="button"
        class="c-btn c-btn__like "
    >
      <div v-if = "this.isLikedBy === false"> 気になる</div>
      <div v-if = "this.isLikedBy === true"> 解除</div>  
        <i class="fas fa-heart fa-2x"
        :class="{'c-btn__fa--red':this.isLikedBy}"
        @click="clickLike"  
        />
             
    </button>
</template>

<script>
 export default {
    props: { // bladeからjsonで送られた値
      initialIsLikedBy: {
        type: Boolean,
        default: false,
      },
      endpoint: {
        type: String,
      },
    },

    data() { // 初期値
      return {
        isLikedBy: this.initialIsLikedBy, // trueならハートが赤色になる
      }
    },

    methods: {
      clickLike() {
        this.isLikedBy
          ? this.unlike()
          : this.like()
      },

      async like() { 
        //web.php参照 endpoint="{{ route('ideas.like', ['idea' => $idea]) }}" 
        const response = await axios.put(this.endpoint)

        this.isLikedBy = true // ハートを赤くする
        //this.countLikes = response.data.countLikes
        alert('気になるリストに登録しました')
      },
      async unlike() {
        const response = await axios.delete(this.endpoint)

        this.isLikedBy = false
        //this.countLikes = response.data.countLikes
        alert('気になるリストから削除しました')
      },
    },
    
  }
</script>