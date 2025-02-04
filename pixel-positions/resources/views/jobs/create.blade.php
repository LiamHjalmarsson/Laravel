<x-layout>
    <x-page-heading>
        New Job
    </x-page-heading>

    <x-forms.form method="POST" action="/jobs">
        <x-forms.input label="Title" name="title" />
        <x-forms.input label="Salary" name="salary" />
        <x-forms.input label="Location" name="location" />  

        <x-forms.select label="Type" name="type">
            <option>Remote</option>
            <option>Hybrid</option>
            <option>On site</option>
        </x-forms.select>

        <x-forms.select label="Schedule" name="schedule">
            <option>Full time</option>
            <option>Part time</option> 
            <option>Extra</option>
        </x-forms.select>

        <x-forms.input label="Url" name="url" />

        <x-forms.checkbox label="Featured" name="featured" />

        <x-forms.divider />

        <x-forms.input label="Tags (comma separated)" name="tags" />

        <x-forms.button>
            Publish
        </x-forms.button>

    </x-forms.form>
</x-layout>
