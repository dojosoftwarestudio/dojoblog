<template>
	  <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">TAGS ADMIN</h1>
          <p class="mb-4">TAGS NAME.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                  TAGS ADMIN
              </h6>
                <Button @click="addModal=true">
                    <Icon type="md-add"></Icon> Add Tag
                </Button>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" v-if="tags.length">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Tag Name</th>
                      <th>created at</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(tag,i) in tags" :key="i" v-if="tags.length">
                      <td>{{tag.id}}</td>
                      <td>{{tag.tagName}}</td>
                      <td>{{tag.created_at}}</td>
                      <td>
                        <Button @click="showEdit(tag)" type="info" size="small">
                            <Icon type="ios-create"></Icon> Edit
                        </Button>
                        <Button type="error" size="small" @click="showDeletingModal(tag, i)"  :loading="tag.isDeleting" >Delete</Button>
                      </td>
                    </tr>

                  </tbody>
                </table>
                <h2 v-else>
                    NO hay tags
                </h2>

              </div>
            </div>
          </div>

        <!-- TAGS CREATE MODAL -->
        <Modal
            v-model="addModal"
            title="Add tag modal"
            :mask-closable="false"
            :closable="false">
            <Input v-model="data.tagName" placeholder="Tag Name" autofocus clearable  />
            <div slot="footer">
                <Button type ="default" size="small" @click="addModal=false">Close</Button>
                <Button type="primary" size="small" @click="addTag()" :loading="isAdding" :disabled="isAdding">{{isAdding ? 'Adding..':'Add Tag'}}</Button>
            </div>
        </Modal>

        <!-- TAGS EDIT MODAL -->
        <Modal
            v-model="editModal"
            title="Edit tag modal"
            :mask-closable="false"
            :closable="false">
            <Input v-model="editTag.tagName" placeholder="Tag Name" autofocus />
            <div slot="footer">
                <Button type ="default" size="small" @click="editModal=false">Close</Button>
                <Button type="primary" size="small" @click="updateTag()" :loading="isAdding" :disabled="isAdding">{{isAdding ? 'Editing..':'Edit Tag'}}</Button>
            </div>
        </Modal>

        <deleteModal></deleteModal>
    </div>

</template>
<script>
import deleteModal from '../commons/deleteModal'
import {mapGetters} from 'vuex'

  export default{
    data(){
      return {
        data: {tagName: ''},
        editTag:{ tagName:''},
        addModal: false,
        editModal: false,
        isAdding: false,
        tags:[],
      }
    },
    components:{
        deleteModal
    },
    methods:{
        list: async function(){
            const res = await this.callApi('get', 'tag/list')
            if(res.status === 200){
                this.tags = res.data
            }
            else{
                this.swr()
            }
        },
        addTag: async function(){
            if(this.data.tagName.trim() === '') return this.e('Tag name is required')

            const res = await this.callApi('post', 'tag/create', this.data)
            if(res.status === 201){
                this.s('Tag has been successfull')
                this.addModal = false
                this.data.tagName = ""
                this.list()
            }else{
                if(res.status === 422){
                    if(res.data.errors){
                        this.e(res.data.errors.tagName[0])
                    }
                }else{
                    this.swr()
                }
            }
        },
        updateTag: async function(){
            if(this.editTag.tagName.trim() === '') return this.e('Tag name is required')
            const res = await this.callApi('post', 'tag/update', this.editTag)
            if(res.status === 200){
                this.s('Tag has been successfull')
                this.editModal = false
                this.data.tagName = ""
                this.list()
            }else{
                if(res.status === 422){
                    if(res.data.errors){
                        this.e(res.data.errors.tagName[0])
                    }
                }else{
                    this.swr()
                }
            }
        },
        showEdit: function(tag){
            let obj = {
                id: tag.id,
                tagName: tag.tagName
            }
            this.editTag = obj
            this.editModal = true
        },
        showDeletingModal: function (tag, i){
            const deleteModalObj = {
                showDeleteModal: true,
                deleteUrl: 'tag/delete',
                method: 'delete',
                data: tag,
                isDeleted: false,
            }
            this.$store.commit('setDeletingModalObj', deleteModalObj)
        }
    },
    computed:{
        ...mapGetters(['getDeleteModalObj'])
    },
    watch:{
        getDeleteModalObj(obj){
            console.log("VALOR PARA LISTAR OTRA VEZ ", obj.isDeleted)
            if(obj.isDeleted){
                this.list()
            }
        }
    },
    created(){
        this.list()
    }
  }

</script>