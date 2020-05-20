<template>
	  <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">CATEGORY ADMIN</h1>
          <p class="mb-4">CATEGORY NAME.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                  CATEGORY ADMIN
              </h6>
              <Button @click="addModal=true">
                    <Icon type="md-add"></Icon> Add Category
                </Button>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Tag Name</th>
                      <th>Icon</th>
                      <th>created at</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(category,i) in categories" :key="i" v-if="categories.length">
                      <td>{{category.id}}</td>
                      <td>{{category.categoryName}}</td>
                      <td class="table_image">
                        <Avatar :src="category.icon" />
                      </td>
                      <td>{{category.created_at}}</td>
                      <td>
                        <Button @click="showEdit(category)" type="info" size="small">
                            <Icon type="ios-create"></Icon> Edit
                        </Button>
                        <Button type="error" size="small" @click="showDeletingModal(category, i)"  :loading="category.isDeleting" >Delete</Button>
                      </td>
                    </tr>

                  </tbody>
                </table>

              </div>
            </div>
          </div>

        <!-- TAGS CREATE MODAL -->
        <Modal
            v-model="addModal"
            title="Add Category"
            :mask-closable="false"
            :closable="false">
            <Input v-model="data.categoryName" placeholder="Category Name" autofocus clearable  />
            <br><br>
            <Upload
                ref="uploadBox"
                type="drag"
                action="/category/upload"
                :headers="{'x-csrf-token': token, 'X-Requested-With':'XMLHttpRequest'}"
                :format="['jpg','jpeg','png']"
                :on-success="handleSuccess"
                :on-format-error="handleFormatError"
                :on-error="handleError"
                :on-exceeded-size="handleMaxSize">
                <div style="padding: 20px 0">
                    <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                    <p>Seleccione un archivo</p>
                </div>
            </Upload>
            <div class="demo-upload-list" v-if="data.icon">
                <img :src="`/uploads/${data.icon}`">
                <div class="demo-upload-list-cover">
                    <Icon type="ios-trash-outline" @click="deleteImage()"></Icon>
                </div>
            </div>
            <div slot="footer">
                <Button type ="default" size="small" @click="addModal=false">Close</Button>
                <Button type="primary" size="small" @click="addCategory()" :loading="isAdding" :disabled="isAdding">{{isAdding ? 'Adding..':'Add Category'}}</Button>
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
        <!-- /.container-fluid -->
</template>
<script>
import deleteModal from '../commons/deleteModal'
import {mapGetters} from 'vuex'
  export default{
    data(){
      return {
        token: '',
        data: {categoryName: '',icon:''},
        editTag:{ categoryName:'',icon:''},
        addModal: false,
        editModal: false,
        isAdding: false,
        categories:[],
      }
    },
    components:{
        deleteModal,
    },
    methods:{
        list: async function(){
            const res = await this.callApi('get', 'category/list')
            if(res.status === 200){
                this.categories = res.data
            }
            else{
                this.swr()
            }
        },
        addCategory: async function(){
            if(this.data.categoryName.trim() === '') return this.e('Category name is required')
            if(this.data.icon.trim() === '') return this.e('Icon is required')
            this.data.icon = `/uploads/${this.data.icon}`
            const res = await this.callApi('post', 'category/create', this.data)
            if(res.status === 201){
                this.s('Category has been successfull')
                this.addModal = false
                this.data.categoryName = ""
                this.data.icon = ""
                this.list()
            }else{
                if(res.status === 422){
                    if(res.data.errors){
                        this.e(res.data.errors)
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
        deleteTag: async function(tag, i){
            if(!confirm("Seguro???")) return
            this.$set(tag, 'isDeleting', true)
            const res = await this.callApi('delete', 'tag/delete', tag)
            if(res.status === 200){
                this.s("Tag has been deleted")
                this.list()
            }else{
                this.swr()
            }
        },
        // UPLOADER
        handleError(res, file){
            this.$Notice.warning({
                title: 'Formato Incorrecto',
                desc: file.errors.file.length ? file.errors.file : 'Algo salió mal!!!'
            });
        },
        handleView (name) {
            this.imgName = name;
            this.visible = true;
        },
        handleRemove (file) {
            const fileList = this.$refs.upload.fileList;
            this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
        },
        handleSuccess (res, file) {
            console.log("OK sending data")
            this.data.icon = res
        },
        handleFormatError (file) {
            this.$Notice.warning({
                title: 'The file format is incorrect',
                desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
            });
        },
        handleMaxSize (file) {
            this.$Notice.warning({
                title: 'Exceeding file size limit',
                desc: 'File  ' + file.name + ' is too large, no more than 2M.'
            });
        },
        async deleteImage(){
            let icon = this.data.icon
            this.data.icon = ''
            this.$refs.uploadBox.clearFiles()
            const res = await this.callApi('delete','category/deleteIcon',{icon})
            console.log(res)
            if(res.status != 200){
                this.data.icon = icon
                this.swr()
            }
        },
        showDeletingModal: function (category, i){
            const deleteModalObj = {
                showDeleteModal: true,
                deleteUrl: 'category/delete',
                method: 'delete',
                data: category,
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
        this.token = window.Laravel.csrfToken
        this.list()
    }
  }

</script>
<style>
    .demo-upload-list{
        display: inline-block;
        width: 60px;
        height: 60px;
        text-align: center;
        line-height: 60px;
        border: 1px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        background: #fff;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,.2);
        margin-right: 4px;
    }
    .demo-upload-list img{
        width: 100%;
        height: 100%;
    }
    .demo-upload-list-cover{
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,.6);
    }
    .demo-upload-list:hover .demo-upload-list-cover{
        display: block;
    }
    .demo-upload-list-cover i{
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        margin: 0 2px;
    }
</style>