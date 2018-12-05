<template>
    <div>
        <div class="form-group">
            <label class="control-label">Selecionar estudante</label>
            <select name="students" class="form-control"></select>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th></th>
                <th>Nome</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="student in students">
                <td>Excluir</td>
                <td>{{student.user.name}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import ADMIN_CONFIG from '../../services/adminConfig'
    import store from '../../store/store'
    import 'select2'
    export default {
        name: "ClassStudent",
        props: ['ClassInformation'],
        computed:{
            students(){
                return store.state.classStudent.students
            }
        },
        mounted(){
            store.dispatch('classStudent/query', this.ClassInformation)
            $("select[name=students]").select2({
                ajax: {
                    url: `${ADMIN_CONFIG.API_URL}/students`,
                    dataType: 'json',
                    delay: 250,
                    processResults(data){

                    }
                }
            })
        }
    }
</script>