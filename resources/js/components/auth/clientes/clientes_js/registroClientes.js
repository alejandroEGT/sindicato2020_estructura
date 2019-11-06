export default {
    data () {
      return {
        loading1: false,
        loading2: false,
        progress: false
      }
    },
  
    methods: {
      simulateProgress (number) {
        // we set loading state
        this[`loading${number}`] = true
        // simulate a delay
        setTimeout(() => {
          // we're done, we reset loading state
          this[`loading${number}`] = false
        }, 3000)
      }
    }
  }