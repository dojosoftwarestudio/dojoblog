export default{
	data(){
			return {}
	},
	methods: {
		callApi: async function(method, url, dataInput){
			try{
				return await axios({
					method: method,
					url: url,
					data: dataInput
				})
			}
			catch(e){
				return e.response
			}
		},
		i (desc, title = "Hey!") {
            this.$Notice.info({
                title: title,
                desc: desc
            });
        },
        s (desc, title = "Great!") {
            this.$Notice.success({
               	title: title,
            	desc: desc
            });
        },
        w (desc, title = "oops") {
            this.$Notice.warning({
                title: title,
            	desc: desc
            });
        },
        e (desc, title = "Error") {
            this.$Notice.error({
                title: title,
            	desc: desc
            });
        },
		swr (desc = "Algo salio mal intente nuevamente", title = "Oops") {
            this.$Notice.error({
                title: title,
            	desc: desc
            });
        },
	},
}