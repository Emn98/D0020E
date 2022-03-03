class Time
{
    constructor(hour, min, sec)
    {
        this.hour = parseInt(hour);
        this.min = parseInt(min);
        this.sec = parseInt(sec);

        if(this.invalid_time())
        {
            throw new Error("Not a valid time");
            
        }
    }

    get_time()
    {
        return "time(" + this.hour + "," + this.min + "," + this.sec + ")";
    }

    invalid_time()
    {
        if(isNaN(this.hour) || this.hour > 23 || this.hour < 0)
        {
            return true;
        }
        if(isNaN(this.min) || this.min > 59 || this.min < 0)
        {
            return true;
        }
        if(isNaN(this.sec)  || this.sec > 59 || this.sec < 0)
        {
            return true;
        }
        return false;
    }

    is_bigger(time)
    {
        if(this.hour > time.hour)
        {
            return true;
        }
        if(this.min > time.min)
        {
            return true;
        }
        if(this.sec > time.sec)
        {   
            return true;
        }
        return false;
    }
}

class Time_in_range extends Condition
{
    constructor(association_ids, earliestTime, latestTime)
    {
        super(association_ids);
        this.earliestTime = earliestTime;
        this.latestTime = latestTime;

        if(this.earliestTime.is_bigger(this.latestTime))
        {
            throw new Error("Not a valid time");
        }

    }

    get_condition_definition()
    {
        return "time_in_range(" + this.earliestTime.get_time() + ",time_now," + this.latestTime.get_time() + ")";
    }

    static create_time_in_range(associations, earliestTime, latestTime)
    {
        
        let cond = new Time_in_range(associations, earliestTime, latestTime);
        
        send_values_with_post(cond.get_condition_definition(), cond.get_association_ids());
    }
}