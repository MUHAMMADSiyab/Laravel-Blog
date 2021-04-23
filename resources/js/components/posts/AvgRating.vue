<template>
  <star-rating :rating="rating" :star-size="15" :read-only="true"></star-rating>
</template>

<script>
import StarRating from "vue-star-rating";

export default {
  components: {
    StarRating,
  },

  props: ["rating"],
};
</script>

<style scoped>
.avg-rating {
  width: 37%;
  margin-left: 3px;
  padding: 5px;
  position: absolute;
  height: 20px;
  line-height: 20px;
  background: #f7f7f7;
  text-align: center;
  top: -10px;
  border-radius: 2px;
  right: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>