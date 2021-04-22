<template>
  <form class="mt-2" @submit.prevent="update">
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
      <button class="btn btn-success btn-sm" type="submit">
        Update Comment
      </button>
    </div>
  </form>
</template>

<script>
export default {
  props: ["comment"],

  data() {
    return {
      errors: null,
      data: {
        post_id: this.comment.post_id,
        body: this.comment.body,
      },
    };
  },

  methods: {
    async update() {
      try {
        const res = await axios.put(
          `/api/comments/${this.comment.id}`,
          this.data
        );

        this.$emit("comment-updated", res.data);

        this.data.body = "";
      } catch (error) {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors;
          this.error = null;
        }
      }
    },
  },

  watch: {
    comment: {
      handler(comment) {
        this.data.post_id = comment.post_id;
        this.data.body = comment.body;
      },
      deep: true,
    },
  },
};
</script>