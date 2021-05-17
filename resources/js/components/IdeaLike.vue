<template>
  <div v-if = "this.isLikedBy === true" class="c-flexbox__flexitem c-flexbox__flexitem--index">

    <div class="p-card p-card__title u-overflow">{{idea.name}}</div>

    <div class="p-card p-card__body">
      <table class="p-table p-table--index">
          <td class="c_category">{{category.name}}</td>
      </table>
      <table class="p-table p-table--index u-border__none--top">                    
          <td class="u-overflow"><p>概要</p>{{ idea.description }}</td>
      </table>

      <table class="p-table p-table--index u-border__none--top">
          <td>登録日{{idea.updated_at}}</td>
      </table>
      <table class="p-table p-table--index u-border__none--top">
              <td class="">{{idea.price}}円</td>
      </table>
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
    </div>

    <div class="p-card__footer">      
      <a :href="route"> 詳細をみる</a>
    </div>

  </div>
</template>

<script>
 export default {
    props: 
    { // bladeからjsonで送られた値
      idea:{
         type: String,
      },
      category:{
         type: String,
      },
      route: { 
        type: String, required: true 
      },
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