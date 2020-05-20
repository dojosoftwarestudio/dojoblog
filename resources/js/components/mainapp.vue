<template>
	<!-- <div id="wrapper" v-if="loggedIn"> -->
	<div id="wrapper">
	<sidemenu/>
    <div id="content-wrapper" class="d-flex flex-column">
	  	<div id="content">
			<topnav/>
	  		<router-view/>
	  	</div>
		<footer class="sticky-footer bg-white">
			<div class="container my-auto">
			  <div class="copyright text-center my-auto">
			    <span>Copyright &copy; DOJO 2020</span>
			  </div>
			</div>
		</footer>
  	</div>
	</div>
	<!-- <div v-else>
		<login/>
	</div> -->
</template>
<script>
export default{
	data(){
		return{
			loggedIn:false
		}
	}
}
</script>