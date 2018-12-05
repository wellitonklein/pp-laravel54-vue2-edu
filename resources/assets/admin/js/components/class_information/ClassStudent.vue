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
                <td>Remover</td>
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
        props: ['classInformation'],
        computed:{
            students(){
                return store.state.classStudent.students
            }
        },
        mounted(){
            store.dispatch('classStudent/query', this.classInformation)
            $("select[name=students]").select2({
                ajax: {
                    url: `${ADMIN_CONFIG.API_URL}/students`,
                    dataType: 'json',
                    delay: 250,
                    data(params){
                        return {
                            q: params.term
                        }
                    },
                    processResults(data){
                        return {
                            results: data.map((student) => {
                                return {id: student.id, text: student.user.name}
                            })
                        }
                    }
                },
                minimumInputLength: 3
            })

            let self = this

            $("select[name=students]").on('select2:select', event => {
                store.dispatch('classStudent/store', {
                    studentId: event.params.data.id,
                    classInformationId: self.classInformation
                }).then(() => alert('Aluno adicionado com sucesso'))
            })
        }
    }
</script>