<template>
	<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
              	<img :src="`/public/images/logodojo.png`" alt="">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome DOJOBLOG</h1>
                  </div>
                    <div class="form-group">
                    	<Input type="email" placeholder="Username" v-model="data.email">
			                <Icon type="ios-person-outline" slot="prepend"></Icon>
			            </Input>
                    </div>
                    <div class="form-group">
                      	<Input type="password" placeholder="Password" v-model="data.password">
			                <Icon type="ios-lock-outline" slot="prepend"></Icon>
			            </Input>
                    </div>
                   <Button type="primary" long @click="login()" :disabled="isLogging" :loading="isLogging">{{ isLogging ?'Logueando...':'Login'}}</Button>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default{
	data(){
		return {
			data:{email: '',password:''},
			isLogging: false,
		}
	},
	methods:{
		login: async function(){
			if(this.data.email.trim()=='') return this.e("Email required")
			if(this.data.password.trim()=='') return this.e("Password required")
			if(this.data.password.trim().length < 6) return this.e("Incorrect login details")
			this.isLogging = true
			const res = await this.callApi('post', 'user/login', this.data)
			if(res.status == 200){
				this.s(res.data.msg)
			}else{
				if(res.status == 401){
					this.i(res.data.msg)
				}else{
					this.swr()
				}
			}
			this.isLogging = false
		}
	}
}
</script>