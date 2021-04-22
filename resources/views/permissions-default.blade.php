@hasrole('teacher')
  <p>You have been assigned the [teacher] role.</p>
@else
  <p>You do NOT have the teacher role.</p>
@endhasrole

@hasrole('super-admin')
  <p>You have been assigned the [Super Admin] role.</p>
@endhasrole

@can('edit assignments')
  <p>You have permission to [edit assignments].</p>
@else
  <p>Sorry, you may NOT edit assignments.</p>
@endcan