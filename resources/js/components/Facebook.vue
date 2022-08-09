<template>
  <div>
        <button class="btn btn-info waves-effect waves-light btn-sm" @click="fbData">Get Pages </button>

        <ul class="list-group mt-2">
            <li class="list-group-item d-flex justify-content-between align-items-center" v-for="page in pages" >
                <div><i class="la la-check text-success mr-2"></i>{{page.name}}</div>
                <button class="btn btn-info waves-effect waves-light btn-sm" @click="setDefaultPage(page)">Set Default Page</button>
            </li>
        </ul>

      
  </div>
</template>

<script>
export default{
    data(){
        return{
            pages:{},
            page_id:null,
        }
    },
    watch:{

    },
    methods:{
        fbData(){
            axios.get('facebook/page/data')
            .then(response => {
                //console.log(response.data);
                this.page_id = $('#page_id').val();
                this.pages = response.data;
                console.log(this.pages);
            }) 
            .catch(error => {
                console.log(error);
                toast({
                    type: "error",
                    title: "Error while fetching data from facebook"
                });
            });

        },

        setDefaultPage(page){
            axios.post('facebook/page/add',{page_id : page.id})
            .then(response => {
                console.log(response.data);
                $('#page_id').val(page.id);
               toast({
                    type: "success",
                    title: page.name + " sets as default page"
                });
            }) 
            .catch(error => console.log(error))
        }
    },
    created(){
        
    }
};
</script>

<style>

</style>
