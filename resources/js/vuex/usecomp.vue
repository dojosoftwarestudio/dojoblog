<template>
	<div class="container-fluid">
		<h1>
			I will a show all components (A,B,C)
		</h1>
		current state of counter in MASTER is {{ counter }}
		<div>
			<compA></compA>
			<compB></compB>
			<compC></compC>
		</div>
		<Button type="info" @click="changeCounter()">Change</Button>
	</div>
</template>
<script>
	import compA from './compA'
	import compB from './compB'
	import compC from './compC'
	import {mapGetters} from 'vuex'

	export default{
		data(){
			return{
			}
		},
		created(){
			console.log(this.$store.state.counter)
		},
		computed:{
			...mapGetters({'counter':'getCounter'})
		},
		methods:{
			changeCounter: function(){
				this.$store.dispatch('changeCounterAction',1)
				//this.$store.commit('changeTheCounter', 1)
			},
			messageChange(){
				console.log('i am changing')
			}
		},
		components: {
			compA,
			compB,
			compC,
		},
		watch:{
			counter: function (value){
				console.log('Change counter ', value)
				this.messageChange()
			}
		}
	}
</script>