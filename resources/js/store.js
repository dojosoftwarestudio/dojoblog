import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
	state:{
		counter: 1000,
		deleteModalObj: {
			showDeleteModal: false,
			deleteUrl: '',
			method: '',
			data: null,
			isDeleted: false,
		}
	},
	getters:{
		getCounter: function (state){
			return state.counter
		},
		getCounterByHalf: function (state){
			return state.counter/2
		},
		getDeleteModalObj:function(state){
			return state.deleteModalObj
		}
	},
	mutations:{
		changeTheCounter: function (state, data){
			state.counter += data
		},
		setDeleteModal: function(state, data){
			const deleteModalObj = {
                showDeleteModal: false,
                deleteUrl : '',
                data : null,
                deletingIndex: -1,
                isDeleted : data,
            }
            state.deleteModalObj = deleteModalObj
		},
		setDeletingModalObj: function(state, data){
			state.deleteModalObj = data
		},

	},
	actions:{
		changeCounterAction: function ({commit}, data){
			commit('changeTheCounter', data)
		}
	}

})