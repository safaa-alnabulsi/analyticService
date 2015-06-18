<?php

/**
 * This is the model class for table "event".
 *
 * The followings are the available columns in table 'event':
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property string $referrer_url
 * @property string $datetime
 */
class Endpoint extends CActiveRecord
{
    /**
     * Number of distinct column
     * @var integer
     */
    public $count;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'event';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, value, referrer_url, datetime', 'required'),
            array('name, value', 'length', 'max' => 50),
            array('referrer_url', 'length', 'max' => 550),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, value, referrer_url, datetime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
            'referrer_url' => 'Referrer Url',
            'datetime' => 'Datetime',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('value', $this->value, true);
        $criteria->compare('referrer_url', $this->referrer_url, true);
        $criteria->compare('datetime', $this->datetime, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Endpoint the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     *  Gets the Events models from database grouped by given column
     * @param string $columnName name of the column we want to get its data
     * @return array holds the event models
     */
    private static function groupBy($columnName)
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'id,count(*) AS count,' . $columnName;
        $criteria->group = $columnName;
        $events = Endpoint::model()->findAll($criteria);

        return $events;
    }

    /**
     *  Gets the Events info for the chart with its count
     * @param string $columnName name of the column we want to get its data
     * @return array holds the events info
     */
    public static function getChartEvents($columnName)
    {
        $events = Endpoint::groupBy($columnName);
        $eventsName = array();
        $eventsCounts = array();
        foreach ($events as $event) {
            $eventsName[] = $event->$columnName;
            $eventsCounts[] = $event->count;
        }

        return array('eventsName' => $eventsName, 'eventsCounts' => $eventsCounts);
    }


    /**
     *  Gets the Events info for the grid with its count
     * @param string $columnName name of the column we want to get its data
     * @return array holds the events ino
     */
    public static function getGridEvents($columnName)
    {
        $events = Endpoint::groupBy($columnName);

        $eventsInfo = array();
        foreach ($events as $event) {
            $eventInfo = array();
            $eventInfo['id'] = $event->id;
            $eventInfo[$columnName] = $event->$columnName;
            $eventInfo['count'] = $event->count;
            $eventsInfo[] = $eventInfo;
        }

        return $eventsInfo;
    }

    /**
     * Calculate the step and the scale width of the chart
     * @param $eventsInfo
     * @return array
     */
    public static function getChartOptions($eventsInfo)
    {
        $options = array();
        if (count($eventsInfo['eventsCounts']) > 0) {
            $max = max($eventsInfo['eventsCounts']);
            $min = min($eventsInfo['eventsCounts']);
            $options = array(
                "scaleOverride" => true,
                "scaleSteps" => $max,
                "scaleStepWidth" => $min,
                "scaleStartValue" => 0
            );
        }

        return $options;
    }

    /**
     * Display the result image , success or error
     * @param string $result success or error
     */
    public function displayResult($result)
    {
        $image = "images/" . $result . '.png';
        header('Content-type: image/png');
        header('Content-Length: ' . filesize($image));
        readfile($image);
    }
}
