class IS_weekday extends Condition
{
    constructor(association_ids)
    {
        super(association_ids);
    }

    get_condition_definition()
    {
        return "is_weekday";
    }

    static create_IS_weekday(associations)
    {
        let cond = new IS_weekday(associations);
        
        send_values_with_post(cond.get_condition_definition(), cond.get_association_ids());
    }
}