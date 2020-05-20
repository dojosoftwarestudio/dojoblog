<template>
	<div>
	 <!-- delete alert modal -->
        <Modal
        :value="getDeleteModalObj.showDeleteModal"
        :mask-closable="false"
		:closable="false"
         width="360">
            <p slot="header" style="color:#f60;text-align:center">
                <Icon type="ios-information-circle"></Icon>
                <span>Delete confirmation</span>
            </p>
            <div style="text-align:center">
                <p>Are you sure you want to delete this element?.</p>

            </div>
            <div slot="footer">
                <Button type="default" size="large" @click="closeModal" >Close</Button>
                <Button type="error" size="large"  :loading="isDeleing" :disabled="isDeleing" @click="deleteTag" >Delete</Button>
            </div>
        </Modal>
	</div>
</template>
<script>
	import {mapGetters} from 'vuex'
	export default{
		data(){
			return {
				isDeleing: false,
			}
		},
		methods:{
			deleteTag: async function (){
				this.isDeleting = true
				const res = await this.callApi('delete',this.getDeleteModalObj.deleteUrl,this.getDeleteModalObj.data)
				if(res.status == 200){
					this.s("Delete Success")
					this.$store.commit('setDeleteModal' , true)
				}else{
					this.swr()
					this.$store.commit('setDeleteModal' , true)
				}
				this.isDeleting = false
			},
			closeModal(){
	            this.$store.commit('setDeleteModal', false)
	        }
		},
		computed:{
			...mapGetters(['getDeleteModalObj'])
		}
	}
</script>