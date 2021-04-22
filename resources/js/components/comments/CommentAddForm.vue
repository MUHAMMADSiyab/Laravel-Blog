<template>
  <form class="mt-2" @submit.prevent="add">
    <div class="form-group">
      <textarea
        name="body"
        id="body"
        rows="2"
        class="form-control"
        v-model="data.body"
      ></textarea>

      <span
        class="error text-danger"
        v-if="errors && errors['body']"
        v-text="errors['body'][0]"
      ></span>
    </div>

    <div class="form-group mt-1">
      <button class="btn btn-primary btn-sm" type="submit">Post Comment</button>
    </div>
  </form>
</template>

<script>
export default {
  props: ["postId"],

  data() {
    return {
      errors: null,
      data: {
        post_id: this.postId,
        body: "",
      },
    };
  },

  methods: {
    async add(e) {
      try {
        const res = await axios.post("/api/comments", this.data);

        this.$emit("comment-added", res.data);

        this.data.body = "";
      } catch (error) {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors;
          this.error = null;
        }
      }
    },
  },
};
</script>