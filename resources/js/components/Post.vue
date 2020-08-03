<template>
  <div>
    <button
      type="button"
      class="btn btn-success float-right"
      data-toggle="modal"
      data-target="#exampleModal">New Post
    </button>

    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true">

      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Title:</label>
                <input type="text" :class="['form-control', errors.title ? 'is-invalid' : '']" v-model="post.title" id="recipient-name" />
                <small v-if="errors.title" class="form-text text-danger"> {{errors.title[0]}} </small>
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">body:</label>
                <textarea :class="['form-control', errors.body ? 'is-invalid' : '']" v-model="post.body" id="message-text"></textarea>
                <small v-if="errors.body" class="form-text text-danger"> {{errors.body[0]}} </small>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" @click="createpost" >Create</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            post:{
                id:'',
                user_id:'',
                title:'',
                body:'',
            },
            errors:[]
        }
    },
    methods:{
        createpost()
        {
            axios.post('createpost',this.post).then(response=>{
                if(response.data.status == 'errors') {
                    this.errors = response.data.errors
                } else if (response.data.status == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Created successfully'
                    })
                }
            })
        }
    }
}
</script>
