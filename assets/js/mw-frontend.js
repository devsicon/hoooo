
let displayApp = Vue.createApp({

    data() {
      return {
        freeze: false,
        rolling: false,
        wheelDeg: 0,
        prizeNumber: 6,
        prizeListOrigin: [
          { name: "$10000" },
          { name: "Thank you!" },
          { name: "$500" },
          { name: "$100" },
          { name: "Thank you! Thak you" },
          { name: "$50" },
          { name: "$10" },
          { name: "Thank you!" }
      ] 
    };
  
  
  
    },
    computed: {
      prizeList() {
        return this.prizeListOrigin.slice(0, this.prizeNumber);
      } },
  
    methods: {
      onClickRotate() {
        if (this.rolling) {
          return;
        }
        const result = Math.floor(Math.random() * this.prizeList.length);
        this.roll(result);
      },
      roll(result) {
        this.rolling = true;
        const { wheelDeg, prizeList } = this;
        this.wheelDeg =
        wheelDeg -
        wheelDeg % 360 +
        6 * 360 + (
        360 - 360 / prizeList.length * result);
        setTimeout(() => {
          this.rolling = false;
          alert("Result：" + prizeList[result].name);
        }, 4500);
      } },
  
    watch: {
      prizeNumber() {
        this.freeze = true;
        this.wheelDeg = 0;
  
        setTimeout(() => {
          this.freeze = false;
        }, 0);
      } }
  
  })
  
  displayApp.mount('#displayApp')