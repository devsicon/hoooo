let app = Vue.createApp({
      data() {
          return {

            formData: new FormData(),

            wheelEnbl: '',
            wheelMEnbl: '',
            wheelTitle: '',
            wheelDescription: '',
            wheelBtnText: '',
            wheelWinerMsg: '',
            wheelMcApi: '',
            formFields: [
              {
                wheelOption: 'nocoupon',
                wheelLabel: 'Not Lucky',
                couponAmount: '5',
                wheelColor: '#000000',
              },
              
            ],
          };
        },


        mounted() {
          // Retrieve the data from WordPress options
          this.loadData();
        },

        methods: {
          addField() {
            this.formFields.push({
              wheelOption: 'nocoupon',
              wheelLabel: 'Not Lucky',
              couponAmount: '5',
              wheelColor: '#000000',
            });
          },

          removeField(index) {
            this.formFields.splice(index, 1);
          },

          submitForm() {

            this.formData.append('nonce', vue_form_vars.nonce);
            this.formData.append('action', 'handle_form_submission');

            this.formData.append('wheelenbl', this.wheelEnbl);
            this.formData.append('wheelmenbl', this.wheelMEnbl);            
            this.formData.append('wheeltitle', this.wheelTitle);
            this.formData.append('wheeldescription', this.wheelDescription);
            this.formData.append('wheelbtntext', this.wheelBtnText);
            this.formData.append('wheelwinermsg', this.wheelWinerMsg);
            this.formData.append('wheelmcapi', this.wheelMcApi);
            this.formData.append('formfield', this.formFields);
           

            // this.formFields.forEach((field) => {
            //   // Append each repeatalbe field's data with unique keys
            //   this.formData.append('wheeloption[]', field.wheelOption);
            //   this.formData.append('wheellabel[]', field.wheelLabel);
            //   this.formData.append('couponamount[]', field.couponAmount);
            //   this.formData.append('wheelcolor[]', field.wheelColor);
            // });

            axios.post(vue_form_vars.ajaxurl, this.formData);
          },


          // action: 'get_wheel_data'

          loadData() {

            this.formData.append('action', 'get_wheel_data');

            // Retrieve the data from WordPress options
            axios.post(vue_form_vars.ajaxurl, this.formData)
              .then(response => {
                // console.log(response)
                const data = response.data;
                this.wheelEnbl = data.mw_enabled;
                this.wheelMEnbl = data.mw_m_enabled;
                this.wheelTitle = data.mw_title;
                this.wheelDescription = data.mw_description;
                this.wheelBtnText = data.mw_btn_txt;
                this.wheelWinerMsg = data.mw_win_msg;
                this.wheelMcApi = data.mc_api;
                // this.formFields = data.wheel_data;

                // let add = Object.assign({}, data.wheel_data)

                
                console.log(this.formFields)

                // console.log(Object.keys(data.wheel_data).length);

                
                
               
              
              })
              
          },


        },

      })
  app.mount('#mwApp')





