<template>
  <button :class="classes" @click="subscribe">Subscribe</button>
</template>

<script>
  export default {
    props: ['active'],
    // data() {
    //   return {
    //     active: false
    //   }
    // },

    computed: {
      classes() {
        return ['btn', this.active ? 'btn-primary' : 'btn-default'];
      }
    },

    methods: {
      subscribe() {
        const action = this.active ? 'delete' : 'post';
        axios[action](location.pathname + '/subscriptions')
            .then(() => {
              // Emit an event to notify the parent about the change
              this.$emit('update:active', !this.active);
            })
            .catch(error => {
              console.error('Failed to subscribe/unsubscribe:', error);
            });
        // this.active = ! this.active;
      }
    }
  }
</script>